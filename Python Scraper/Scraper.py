__author__ = 'Andrew'
import requests
import lxml.html as lh
import re

#Variable to test whether or not to build a list of CRN row's used for parsing the data, if 0 wont build a list
#if 1 builds a list of CRN rows this only needs to be run once a semester and is used for getting several fields
#that are designed oddly on the western webpage.  Saves the rows as a txt file so that further testing and parsing
#can be done without parsing the file 6000 times.
print("building crn row.")
build_crn_row_list = 1
#URL of page for course catalog
url = 'https://acsapps.wku.edu/pls/prod/wku_hwsched.P_GetCrse'
#POST data
form_data = [
    ('TERM', '201510'),
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
#Grab page using URL and post data
page1 = requests.post(url, data=form_data)

#Debugging code
# import http.client as http_client
# http_client.HTTPConnection.debuglevel = 1
# 
# import logging
# logging.basicConfig() 
# logging.getLogger().setLevel(logging.DEBUG)
# requests_log = logging.getLogger("requests.packages.urllib3")
# requests_log.setLevel(logging.DEBUG)
# requests_log.propagate = True
#Code to output page as an html document named test, commented out to save  for later
#f = open('test.html', 'w')
#f.write(page1.text)
#Create parse tree from the string of html in page1
tree = lh.fromstring(page1.text)
#temporary storage of row numbers for getting class locations because of
#strange wku website coding.
crn_rows_perm = []
crn_test_list = []
#regular expression that represents a crn so I can get the row numbers of all classes
#in the table on the page
regularExpression = re.compile("\[\'\d{5}\'\]")
#Grab row numbers of all clases on the page

print("About to parse 6000 times to get crn list")

if build_crn_row_list == 1:
    for x in range (0,6500):
        #grab a crn at row x and column 3 should only result in 1 crn in the list at a time.
        crn_test = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr[' + str(x) + ']/td[3]/p/text()')
        #if you find a crn at x row append the row number to the list of row numbers
        if re.match(regularExpression, str(crn_test)):
            crn_rows_perm.append(x)
            crn_test_list.append(crn_rows_perm)

print("crn row list is " + len(crn_rows_perm) + " elements long")


print("outputting crn list to file")
if build_crn_row_list == 1:
    f=open('crn_rows.txt','w')
    for ele in crn_rows_perm:
        f.write(str(ele) + '\n')
    f.close()

if build_crn_row_list == 1:
    g=open('crns_test_list.txt','w')
    for ele in crn_test_list:
        g.write(str(ele) + '\n')
    g.close()

print("Grabbing easy to parse data.")
#Grab the easy to parse data.
crns_list = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr/td[3]/p/text()')
subjs_list = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr/td[4]/p/text()')
crsenum_list = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr/td[5]/p/text()')
sectnum_list = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr/td[6]/p/text()')
cred_list = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr/td[7]/p/text()')
title_list = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr/td[8]/a/text()')
fee_list = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr/td[10]/p/text()')

#location_list = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr/td[12]/p/font/text()')
#days_list = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr/td[13]/p/text()')

with open('crn_rows.txt', 'r') as f:
    crn_rows_perm = f.readlines()
print("starting hard parse 1")
crn_rows = list(crn_rows_perm)
location_list = []
for ele in crn_rows:
    location_list_temp = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr[' + ele + ']/td[12]/p/font/text()')
    if location_list_temp == '':
        location_list.append('TBA')
    else:
        location_list.append(str(location_list_temp))
print("hard parse one finished outputting to txt")
g=open('location_list.txt','w')
for ele in location_list:
    g.write(str(ele) + '\n')
g.close()
print("starting hard parse 2")
crn_rows = list(crn_rows_perm)
days_list = []
for ele in crn_rows:
    days_list_temp = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr[' + ele  + ']/td[13]/p/text()')
    if days_list_temp == '':
        days_list.append('TBA')
    else:
        days_list.append(str(days_list_temp))
print("hard parse 2 being output to txt")
g=open('days_list.txt','w')
for ele in days_list:
    g.write(str(ele) + '\n')
g.close()
print("final hard parse")
crn_rows = list(crn_rows_perm)
times_list = []
for ele in crn_rows:
    times_list_temp = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr[' + ele + ']/td[14]/text()')
    if times_list_temp == '':
        times_list.append('TBA')
    else:
        times_list.append(str(times_list_temp))
print("So much parsing ;_;")
g=open('times_list.txt','w')
for ele in times_list:
    g.write(str(ele) + '\n')
g.close()

crn_rows = list(crn_rows_perm)
instructors_list = []
for ele in crn_rows:
    instructors_list_temp = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr[' + ele + ']/td[17]/p/text()')
    if instructors_list_temp == '':
        instructors_list.append('TBA')
    else:
        instructors_list.append(str(instructors_list_temp))

g=open('instructors_list.txt','w')
for ele in instructors_list:
    g.write(str(ele) + '\n')
g.close()

crn_rows = list(crn_rows_perm)
dates_list = []
for ele in crn_rows:
    dates_list_temp = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tr[' + ele + ']/td[18]/text()')
    if dates_list_temp == '':
        dates_list.append('TBA')
    else:
        instructors_list.append(str(instructors_list_temp))
print("FINALLY LAST ONE")
g=open('dates_list.txt','w')
for ele in dates_list:
    g.write(str(ele) + '\n')
g.close()
print("and done")