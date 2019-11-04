#coding: utf-8
"""
author: thosnun
time: 2019/10/29
desc: a python script to craw the target website's struct,use mysql
"""

import requests
import pymysql
from bs4 import BeautifulSoup
from urllib.parse import urlparse

# 从网站根目录 开始爬取 获取网站结构网络图
def craw(surl):
    urls = list()
    crawed_url = list()
    urls.append(surl)
    _host = urlparse(surl).hostname
    _scheme = urlparse(surl).scheme

    while(len(urls)):
        url = urls[0]
        per_page_urls = list() # get link urls
        per_page_posts = list() # post link urls
        if url not in crawed_url:
            print("crawing page: "+url)

            html = requests.get(url).text
            soup = BeautifulSoup(html,'lxml')
            # GET的链接关系
            # <a href= ... >
            for link in soup.find_all('a'):
                # print(link.get('href'))
                href = link.get('href')
                if href[0:1] == '/':
                    pass
                elif href[0:4] == _scheme:
                    host = urlparse(href)
                    if  host.hostname == _host:
                        # 保留所有页面关系
                        new_url = href
                else:
                    new_url = _scheme+"://"+_host+'/'+href

                per_page_urls.append(new_url)
                if new_url not in urls and new_url not in crawed_url:
                    urls.append(new_url)

            # POST的链接关系
            # <form action= ... >
            for action in soup.find_all('form'):
                a_link = action.get('action')
                a_link_parse = urlparse(a_link)
                if a_link[0:1]=="/":
                    pass
                elif a_link[0:4]==_scheme:
                    if a_link_parse.hostname == _host:
                        new_url = a_link
                else:
                    new_url = _scheme+"://"+_host+"/"+a_link
                if action.get('method')=='post':
                    per_page_posts.append(new_url)
                else:
                    per_page_urls.append(new_url)
                                
            # urls = list(set(urls))
            urls.remove(url) # 清除已经查找过的
            insert_to_db(url,per_page_urls,'gets')
            insert_to_db(url,per_page_posts,'posts')
            crawed_url.append(url)
        else:
            urls.remove(url)

def insert_to_db(url,urls,table):
    db = pymysql.connect('localhost','root','root','webshell')
    cursor = db.cursor()
    for i in urls:
        sql = ("insert ignore into %s (src,dst) values ('%s','%s')"%(table,url,i))
        try:
            cursor.execute(sql)
            db.commit()
        except:
            db.rollback()
    db.close()

if __name__ == "__main__":
    URL = "http://192.168.40.133/"
    craw(URL)