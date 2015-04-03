__author__ = 'Andrew'
import requests
import lxml.html as lh
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


# import http.client as http_client
# http_client.HTTPConnection.debuglevel = 1
# 
# import logging
# logging.basicConfig() 
# logging.getLogger().setLevel(logging.DEBUG)
# requests_log = logging.getLogger("requests.packages.urllib3")
# requests_log.setLevel(logging.DEBUG)
# requests_log.propagate = True


# page1 = requests.post('https://acsapps.wku.edu/pls/prod/wku_hwsched.P_CrseSearch', form_data2)
page1 = requests.post(url, data=form_data)
#page1 = requests.post('https://httpbin.org/post', data=form_data)
#print(page1.text)
f = open('test.html', 'w')
f.write(page1.text)

#Old stuff that wasnt working how I wanted, commented out while I test other things.
#page = requests.post(url, form_data)
tree = lh.document_fromstring(page1.content)
#print(page.text)
#classes = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tbody/tr[3]/td[8]')
#classes2 = tree.xpath('//*[@id="wrapper"]/div[2]/div[2]/form/table/tbody/tr[6]')
#print('Classes: ', classes)
#print('Classes 2: ', classes2)
#print(tree)