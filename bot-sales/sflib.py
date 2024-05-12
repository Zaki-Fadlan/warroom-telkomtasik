from email import message
from lzma import CHECK_ID_MAX
from tabnanny import check
from turtle import up
import mysql.connector
import functools
from operator import index
import time

from telegram import KeyboardButton, ReplyKeyboardMarkup, __version__ as TG_VER
from telegram import InlineKeyboardButton, InlineKeyboardMarkup, Update

import telegram
db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
def tambahwo(chat_id):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql = "INSERT INTO crud_sf (`id_tele`, `order_id`, `sto`, `stamp_amser`, `track_id`, `layanan`, `kecepatan`, `ncp`, `kcp`, `kacp`, `alm_lengkap`, `patokan_alamat`, `desa`, `kecamatan`, `titik_odp`, `tiitik_cp`, `datek_odp`, `est_pj_dc`, `data_inputer`, `ket_sales`) VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)"
    values = [chat_id,"isi","isi","isi","isi","isi","isi","isi","isi","isi","isi","isi","isi","isi","isi","isi","isi","isi","isi","isi"]
    cursor.execute(sql, values)
    return db.commit()

def cekpengisiandata(id,chat_id,table_name):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql = "SELECT "+str(table_name)+" FROM crud_sf WHERE id_tele = "+str(chat_id)
    cursor.execute(sql)
    results = cursor.fetchall()
    # return results
    lst_user= []
    for data in results:
        data = ''.join(data)
        lst_user.append(data)
    if id in lst_user:
        return lst_user.index(id)+1
    else :
        return 0
def cekstatussales(chat_id):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql = "SELECT act FROM idle_sales WHERE id_tele = "+str(chat_id)
    cursor.execute(sql)
    results = cursor.fetchall()
    # return results
    lst_user= ''
    for data in results:
        data = ''.join(str(data))
        lst_user+=data
    return lst_user.replace('(', '').replace(',)','')
    # if id in lst_user:
    #     return lst_user.index(id)+1
    # else :
    #     return 0

def tambahdaata(chat_id,tipekendala,tablename):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql = "UPDATE crud_sf SET "+str(tablename)+" = %s WHERE id_tele = %s"
    values = [tipekendala, chat_id]
    cursor.execute(sql, values)
    return db.commit()

def liststo():
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql = """SELECT nama_sto FROM tb_sto"""
    cursor.execute(sql)
    rows=cursor.fetchall()
    list_wo = []
    for x in rows:
        data = ''.join(x)
        list_wo.append(str(x).replace('(\'','').replace('\',)',''))
    keyboardwo = []
    for kbb in list_wo:
      keyboardwo.append([KeyboardButton(kbb)])
    keyboardwo.append([KeyboardButton("Batal")])
    return keyboardwo
def lislayanan():
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql = """SELECT layanan FROM tb_layanan"""
    cursor.execute(sql)
    rows=cursor.fetchall()
    list_wo = []
    for x in rows:
        data = ''.join(x)
        list_wo.append(str(x).replace('(\'','').replace('\',)',''))
    keyboardwo = []
    for kbb in list_wo:
      keyboardwo.append([KeyboardButton(kbb)])
    keyboardwo.append([KeyboardButton("Batal")])
    return keyboardwo
def liskec():
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql = """SELECT kec FROM tb_kecepatan"""
    cursor.execute(sql)
    rows=cursor.fetchall()
    list_wo = []
    for x in rows:
        data = ''.join(x)
        list_wo.append(str(x).replace('(\'','').replace('\',)',''))
    keyboardwo = []
    for kbb in list_wo:
      keyboardwo.append([KeyboardButton(kbb)])
    keyboardwo.append([KeyboardButton("Batal")])
    return keyboardwo

def destroysesion(chat_id):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql = "DELETE FROM crud_sf WHERE id_tele = "+str(chat_id)
    cursor.execute(sql)
    return db.commit()

def cekidsto(sto):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql ="SELECT id_sto,nama_sto FROM tb_sto"
    cursor.execute(sql)
    results = cursor.fetchall()
    # return results
    lst_user= []
    for data in results:
        # data = ''.join(str(data))
        # lst_user.append(data.replace('(','').replace(')',''))
        lst_user.append(list(data))
    nilai = ""
    for data in lst_user:
        if sto in data :
            nilai += str(data[0])
    return nilai
import random
import string
def generatidorder(sto):
    randomlist = sto+"-"
    for i in range(0,9):
        n = random.randint(0,9)
        randomlist += str(n)
    # letter = string.ascii_lowercase
    # a= str(''.join(random.choice(letter)))
    # letter = string.ascii_uppercase
    # b= str(''.join(random.choice(letter)))
    # letter = string.ascii_letters
    # c= str(''.join(random.choice(letter)))
    # letter = string.digits
    # d= str(''.join(random.choice(letter)))
    # randomlist += a+b+c+d

    return randomlist


def cekidorder(chat_id,id,tablename): 
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql = "SELECT order_id FROM tb_womasuk "
    cursor.execute(sql)
    results = cursor.fetchall()
    # return results
    lst_user= []
    for data in results:
        data = ''.join(data)
        lst_user.append(data)
    letter = string.digits
    d= str(''.join(random.choice(letter)))
    if id in lst_user:
        return cekidorder(chat_id,id,tablename)
    else :
        try:
            return tambahdaata(chat_id,id,tablename)
        except:
            return tambahdaata(chat_id,id+d,tablename)

def pindahdata(chat_id):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql = "SELECT order_id, sto, stamp_amser, track_id, layanan, kecepatan, ncp, kcp, kacp, alm_lengkap, patokan_alamat, desa, kecamatan, titik_odp, tiitik_cp, datek_odp, est_pj_dc, data_inputer, ket_sales, proc_inputer, stat_validasi, status_fcc, proc_helpdesk, mitra, sektor, nama_teknisi, proc_ps, status_sc, no_sc, no_inet, status_wo FROM crud_sf WHERE id_tele = "+str(chat_id)
    cursor.execute(sql)
    results = cursor.fetchall()
    # return results
    lst_user= []
    for data in results:
        data = ''.join(str(data))
        lst_user.append(data)
    lst_user = str(lst_user).replace('["(',"").replace(')"]','').replace("'","")
    datafinal =list(lst_user.split(","))
    sql = "INSERT INTO tb_womasuk (order_id, sto, stamp_amser, track_id, layanan, kecepatan, ncp, kcp, kacp, alm_lengkap, patokan_alamat, desa, kecamatan, titik_odp, tiitik_cp, datek_odp, est_pj_dc, data_inputer, ket_sales, proc_inputer, stat_validasi, status_fcc, proc_helpdesk, mitra, sektor, nama_teknisi, proc_ps, status_sc, no_sc, no_inet, status_wo) VALUES ( %s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)"
    values = [datafinal[0], datafinal[1],datafinal[2],datafinal[3],datafinal[4],datafinal[5],datafinal[6],datafinal[7],datafinal[8],datafinal[9],datafinal[10],datafinal[11],datafinal[12],datafinal[13],datafinal[14],datafinal[15], datafinal[16],chat_id,datafinal[18],'',3,9,'','',1,1,'',1,'','',1]
    cursor.execute(sql, values)
    db.commit()
    sql = "DELETE FROM crud_sf WHERE id_tele = "+str(chat_id)
    cursor.execute(sql)
    return db.commit()

def ceklayanan(order_id):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql ="""SELECT layanan FROM tb_layanan"""
    cursor.execute(sql)
    results = cursor.fetchall()
    # return results
    lst_user= []
    for data in results:
        data = ''.join(data)
        lst_user.append(data)
    # print(lst_user)
    if str(order_id) in lst_user:
        return True
    else :
        return False
def cekecepatan(nama_kecepatan):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql ="""SELECT kec FROM tb_kecepatan"""
    cursor.execute(sql)
    results = cursor.fetchall()
    # return results
    lst_user= []
    for data in results:
        data = ''.join(data)
        lst_user.append(data)
    # print(lst_user)
    if str(nama_kecepatan) in lst_user:
        return True
    else :
        return False
def ceksto(nama_sto):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql ="""SELECT nama_sto FROM tb_sto"""
    cursor.execute(sql)
    results = cursor.fetchall()
    # return results
    lst_user= []
    for data in results:
        data = ''.join(data)
        lst_user.append(data)
    # print(lst_user)
    if str(nama_sto) in lst_user[1:]:
        return True
    else :
        return False

def hasilinput(chat_id):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql ="""SELECT * FROM crud_sf LEFT JOIN tb_sto ON crud_sf.sto = tb_sto.id_sto WHERE id_tele = """+str(chat_id)
    cursor.execute(sql)
    results = cursor.fetchall()
    hasil_data = list(results[0])
    pesan = "Berikut merupakan hasil inputan anda:"
    pesan += "\nOrder ID : " + str(hasil_data[2])
    pesan += "\nTrack ID : " + str(hasil_data[5])
    pesan += "\nSTO : " + str(hasil_data[34])
    pesan += "\nLayanan : " + str(hasil_data[6])
    pesan += "\nKecepatan : " + str(hasil_data[7])
    pesan += "\nNama : " + str(hasil_data[8])
    pesan += "\nKontak : " + str(hasil_data[9])
    pesan += "\nKontak Alternatif : " + str(hasil_data[10])
    pesan += "\nAlamat  : " + str(hasil_data[11])
    pesan += "\nPatokan Alamat  : " + str(hasil_data[12])
    pesan += "\nDesa  : " + str(hasil_data[13])
    pesan += "\nKecamatan  : " + str(hasil_data[14])
    pesan += "\nTitik ODP  : " + str(hasil_data[15])
    pesan += "\nTitik Pelanggan  : " + str(hasil_data[16])
    pesan += "\nDatek ODP  : " + str(hasil_data[17])
    pesan += "\nEstimasi Panjang DC  : " + str(hasil_data[18])
    pesan += "\nKeterangan  : " + str(hasil_data[20])
    return pesan

def cekcrud(id,chat_id):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql = "SELECT id_tele FROM crud_sf WHERE id_tele = "+str(chat_id)
    cursor.execute(sql)
    results = cursor.fetchall()
    # return results
    lst_user= []
    for data in results:
        data = ''.join(data)
        lst_user.append(data)
    if id in lst_user:
        return True
    else :
        return False

def alldatainput(chat_id):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql ="""SELECT order_id FROM tb_womasuk WHERE data_inputer = """+str(chat_id)
    cursor.execute(sql)
    results = cursor.fetchall()
    hasil_data = list(results[0:])
    pesan = "\nTerdeteksi sebanyak "+str(len(hasil_data))+" Order-ID yang telah anda Input. Berikut Merupakan Order ID WO yang telah anda input:"
    no = 1
    for data in hasil_data:
        pesan += "\n"+str(no)+". "+str(data).replace("('", '').replace('\',)','')
        no +=1
    return pesan
def statuswo(order_id,chat_id,username):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql ="""SELECT order_id,stamp_amser,track_id,ncp,alm_lengkap,status,status_fcc,nama_teknisi,nama_status_wo,no_sc,no_inet,proc_ps,kcon,proc_inputer FROM tb_womasuk 
    LEFT JOIN status_wodata ON tb_womasuk.status_wo = status_wodata.id_statuswo 
    LEFT JOIN tb_stvalidasi ON tb_womasuk.stat_validasi = tb_stvalidasi.id_stvalidasi 
    LEFT JOIN tb_sf ON tb_womasuk.data_inputer = tb_sf.id_tele """
    sqlt ="""SELECT * FROM tb_teknisi"""
    sqlf ="""SELECT * FROM tb_statusfcc"""
    sqldatekodp ="""SELECT * FROM tb_woprogress"""
    sqlkendala ="""SELECT * FROM tb_wokendala"""
    cursor.execute(sql)
    results = cursor.fetchall()
    cursor.execute(sqlt)
    resultsteknisi = cursor.fetchall()
    cursor.execute(sqlf)
    resultsfcc = cursor.fetchall()
    cursor.execute(sqldatekodp)
    resultsdatek = cursor.fetchall()
    cursor.execute(sqlkendala)
    resultskendala = cursor.fetchall()

    hasil_data = list(results[0:])
    hasil_datat = list(resultsteknisi[0:])
    hasil_dataf = list(resultsfcc[0:])
    hasil_datadatek = list(resultsdatek[0:])
    hasil_kendala = list(resultskendala[0:])

    pesan = ""
    hasilyangditemukan = []

    for data in hasil_data:
        # print(order_id == (str(data).replace('(\'', '').replace('\')', '').replace('\', \'', ''))[:10])
        if order_id == (str(data).replace('(\'', '').replace('\')', '').replace('\', \'', ''))[:10]:

            nama_teknisi = ["Data Belum Ada"]
            for teknisi in hasil_datat:
                if str(list(data)[7])==str(list(teknisi)[0]) and str(list(teknisi)[0])!="1":
                    nama_teknisi.append((str(list(teknisi)[2])+" || "+str(list(teknisi)[4])+" || "+str(list(teknisi)[3])))

            nama_fcc=["Data Belum Ada"]
            for fcc in hasil_dataf:
                if str(list(data)[6])==str(list(fcc)[0]):
                    nama_fcc.append((str(list(fcc)[1])))

            datek_ket = ['Data Belum Ada']
            for datek in hasil_datadatek:
                if str(list(data)[0])==str(list(datek)[1]):
                    datek_ket.append((str(list(datek)[4])))

            pesan+= "\nHallo Komandan "+username+",berikut merupakan data untuk Order-ID "+list(data)[0]
            pesan+= "\n\nTgl Input :"+list(data)[1]
            pesan+= "\nTrack ID :"+list(data)[2]
            pesan+= "\nNama Pelanggan : "+list(data)[3]
            pesan+= "\nAlamat :"+list(data)[4]
            pesan+= "\nK-Contact Sales : "+list(data)[12]
            pesan+= "\nTgl Validasi : "+str(list(data)[13] )
            pesan+= "\nStatus Validasi : "+str(list(data)[5] )
            pesan+= "\nStatus FCC : "+nama_fcc[-1]
            pesan+= "\nTeknisi : "  +nama_teknisi[-1]
            pesan+= "\nStatus : "+list(data)[8] 
            pesan+= "\nKet ODP: " +str(datek_ket[-1])
            pesan+= "\nNo SC : "+list(data)[9]
            pesan+= "\nNo Inet : "+list(data)[10]
            pesan+= "\nTgl PS : "+list(data)[11]
            # pesan+=(str(data).replace('(\'', '').replace('\')', '').replace('\', \'', ''))[9:]
            hasilyangditemukan.append(str(data))

            for kendala in hasil_kendala:
                if order_id == str(list(kendala)[1]):
                    pesan += "\nTipe Kendala : "+str(list(kendala)[2]).strip()
                    pesan += "\nKeterangan : "+str(list(kendala)[3]).strip()
    
    if len(hasilyangditemukan)>0:
        return pesan
    else:
        return "Order-ID yang anda berikan tidak ditemukan"
    
# print(statuswo('RJP-360229','651949992','zaki'))
def cektrackid(id):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm",
  raise_on_warnings = True
)
    cursor = db.cursor()
    sql = "SELECT track_id FROM tb_womasuk "
    cursor.execute(sql)
    results = cursor.fetchall()
    # return results
    lst_user= []
    for data in results:
        data = ''.join(data)
        lst_user.append(str(data).strip())
    if id in lst_user:
        return lst_user.index(id)+1
    else :
        return 0
def cekhp(id):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm",
  raise_on_warnings = True
)
    cursor = db.cursor()
    sql = "SELECT kcp FROM tb_womasuk "
    sqlt = "SELECT kacp FROM tb_womasuk "
    cursor.execute(sql)
    results = cursor.fetchall()
    cursor.execute(sqlt)
    results2 = cursor.fetchall()
    # return results
    lst_user= []
    
    for data in results:
        data = ''.join(data)
        lst_user.append(str(data).strip())
    for data in results2:
        data = ''.join(data)
        lst_user.append(str(data).strip())
    
    # print(lst_user)
    if id in lst_user:
        return lst_user.index(id)+1
    else :
        return 0

def getstatusteknisi(chat_id):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm",
  raise_on_warnings = True
)
    cursor = db.cursor()
    sql = "SELECT act FROM idle_teknisi WHERE id_tele = "+str(chat_id)
    cursor.execute(sql)
    results = cursor.fetchall()
    return results
    # lst_user= []
    # for data in results:
    #     data = ''.join(str(data)).replace("(","")
    #     lst_user.append((data.replace(",","").replace(')','')))
    # return lst_user
