import requests
import lxml.html as lh
import pymysql
#import necessary python librarys
#Set the URL For the western public course catalog
url = 'https://acsapps.wku.edu/pls/prod/wku_hwsched.P_GetCrse'
#This is the necessary form data that must be sent to the web page.
form_data = [
    ('TERM', '201530'),
    ('sel_subj', 'dummy'),
    ('sel_day', 'dummy'),
    ('sel_schd', 'dummy'),
    ('sel_camp', 'dummy'),
    ('sel_sess', 'dummy'),
    ('sel_instr', 'dummy'),
    ('sel_gecat', 'dummy'),
    ('sel_colcat', 'dummy'),
    ('sel_ptrm', 'dummy'),
    ('sel_openclosed', 'dummy'),
    ('sel_subj', '%'),
    ('sel_instr', '%'),
    ('sel_crse', ''),
    ('sel_title', ''),
    ('sel_ptrm', '%'),
    ('sel_schd', '%'),
    ('sel_camp', 'A'),
    ('sel_sess', '%'),
    ('begin_hh', '0'),
    ('begin_mi', '0'),
    ('begin_ap', 'a'),
    ('end_hh', '0'),
    ('end_mi', '0'),
    ('end_ap', 'a'),
    ('sel_colcat', 'NONE'),
    ('sel_gecat', 'NONE'),
]
#get the the public course catalog page
page = requests.post(url, data=form_data)
#Generate a parse tree from the page's HTML
tree = lh.fromstring(page.text)
#Parse the necessary information from the page, variable names are self explanatory
crns_list = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr/td[3]//text()')
subjs_list = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr/td[4]//text()')
crsenum_list = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr/td[5]//text()')
sectnum_list = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr/td[6]//text()')
cred_list = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr/td[7]//text()')
title_list = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr/td[8]//text()')
fee_list = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr/td[10]//text()')
location_list = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr/td[12]//text()')
days_list = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr/td[13]//text()')
times_list = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr/td[14]//text()')
accounted_list = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr/td[15]//text()')
remaining_list = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr/td[16]//text()')
instructor_list = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr/td[17]//text()')
dates_list = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr/td[18]//text()')
#This removes the extra new line characters from the title list
while len(title_list) != len(crns_list):
    for ele in title_list:
        try:
            title_list.remove('\n')
        except:
            pass
#Open a connection to the mysql database I know this is hard coded but this script resides on the server and not
#accesible by anyone but the admin. This user also only has rights to select, update, and insert into the table.
#It is also only setup to be able to login from the server itself, so even if its unique password were to leak the
#person with the password would also have to have the server's 64 digit unique password to login into it and then run
#any queries.
conn = pymysql.connect(host='localhost', user='Scheduler', passwd='BUUFTeyqAtMPFaROzBuwvMfcUPUnuvafvTOeZDg3XFJ1hGaGSrYdMrRGGpFLfRTF', db='Scheduler2')
cur = conn.cursor()
print("Opened mysql connection to database, updating classes and dates tables")
#While the lists have content pop the element from the list, this block updates the classes and dates tables
while crns_list:
    a = crns_list.pop()
    b = subjs_list.pop()
    c = crsenum_list.pop()
    d = sectnum_list.pop()
    e = cred_list.pop()
    f = title_list.pop()
    g = fee_list.pop()
    h = location_list.pop()
    i = days_list.pop()
    j = accounted_list.pop()
    k = remaining_list.pop()
    l = times_list.pop()
    m = dates_list.pop()
    n = instructor_list.pop()
    #stringfy the title just to be sure, and remove double quotes, theres only one class that needs this but if I dont do
    #it it ruins my whole query
    title_string = str(f)
    title_string = title_string.replace('"', '')
    #if the CRN is a blank character it means its an extra section of the course (a lab or extra meeting date)
    if(a == '\xa0'):
        query = "INSERT INTO `Scheduler2`.`Dates` (`CRN`, `Location`, `Days`, `Date`, `Time`) " + 'VALUES ("' + str(prev_crn) + '","' + str(h) + '","' + str(i) + '","' + str(m) + '","' + str(l) + '")'
        cur.execute(str(query))
        conn.commit()
    #If the its not a blank CRN then its a normal course, insert the information into the dates and classes tables
    else:
        query = "INSERT INTO `Scheduler2`.`Classes` (`CRN` ,`Subject` ,`CourseNum` ,`Section` ,`Credits` ,`Title` , `Fee` , `Accounted`, `Remaining`)" + ' VALUES ("' + str(a) + '","' + str(b) + '","' + str(c) + '","' + str(d) + '","' + str(e) + '","' + str(title_string) + '","' + str(g) + '","' + str(j) + '","' + str(k) + '")'
        query2 = "INSERT INTO `Scheduler2`.`Dates` (`CRN`, `Time`, `Days`, `Location`, `Date`)" + ' VALUES ("' + str(a) + '","' + str(l) + '","' + str(i) + '","' + str(h) + '","' + str(m) + '")'
        prev_crn = a
        cur.execute(str(query))
        conn.commit()
        cur.execute(str(query2))
        conn.commit()
cur.close()
conn.close()
#Parse all the instructors again so we can update the instructors table
instructor_list = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr/td[17]//text()')
instructor_list.reverse()
#This block generates a list of unique instructors by poping a name from the list adding it to unique instructors
#and then removing all other instances of that instructors name from the list
unique_Instructors = []
while instructor_list:
    a = str(instructor_list.pop())
    unique_Instructors.append(a)
    while instructor_list.count(a):
        instructor_list.remove(a)
#This block updates the isntructors table.
print("Starting Database Update: Instructors")
conn = pymysql.connect(host='localhost', user='Scheduler', passwd='BUUFTeyqAtMPFaROzBuwvMfcUPUnuvafvTOeZDg3XFJ1hGaGSrYdMrRGGpFLfRTF', db='Scheduler2')
cur = conn.cursor()
while unique_Instructors:
    b = str(unique_Instructors.pop())
    b = b.replace('"', '')
    #Special case for TBA
    if(b == 'TBA'):
        first = 'TBA'
        last = ''
    else:
        m = [x.strip() for x in b.split(',')]
        first = m.pop()
        last = m.pop()
    query = "INSERT INTO `Scheduler2`.`Instructors` (`FirstName`, `LastName`) VALUES (" + '"' + str(first) + '","' + str(last) + '")'
    cur.execute(str(query))
    conn.commit()
cur.close()
conn.close()
#now we need to generate unique instructor ID's for each instructor.
instructor_list = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr/td[17]//text()')
instructor_list.reverse()
crns_list = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr/td[3]//text()')
crns_list.reverse()
conn = pymysql.connect(host='localhost', user='Scheduler', passwd='BUUFTeyqAtMPFaROzBuwvMfcUPUnuvafvTOeZDg3XFJ1hGaGSrYdMrRGGpFLfRTF', db='Scheduler2')
cur = conn.cursor()
#While there are still CRN's in the list.
while crns_list:
    #pop an instructor from the list
    a = str(instructor_list.pop())
    a = a.replace('"', '')
    b = crns_list.pop()
    #special case for TBA and this date, this has since been fixed but I'll leave it just incase
    if(a == 'TBA' or a == '08/24-12/11'):
        first = 'TBA'
        last = ''
    else:
        #this beginning and end white space and splits at the , in instructor name
        m = [x.strip() for x in a.split(',')]
        #set first and last name variables
        first = m.pop()
        last = m.pop()
        #run a query to get this professors professor ID
    selectQuery = 'SELECT `Scheduler2`.`Instructors`.`InstructorID` FROM `Scheduler2`.`Instructors` WHERE `FirstName` = "' + str(first) + '" AND `LastName` = "' + str(last) + '"'
    cur.execute(selectQuery)
    #get the instructor ID
    instructorID = str(cur.fetchone())
    #its returned with a couple of extra elements (parenthesis and comma) these statements get rid of that
    instructorID = instructorID.replace("(","")
    instructorID = instructorID.replace(")","")
    instructorID = instructorID.replace(",","")
    #update the classes with the proper instructor ID
    query = 'UPDATE `Scheduler2`.`Classes` SET `Classes`.`InstructorID`="' + str(instructorID) +'" WHERE CRN = "' + str(b) + '"'
    cur.execute(str(query))
    conn.commit()
cur.close()
conn.close()
#All finished
