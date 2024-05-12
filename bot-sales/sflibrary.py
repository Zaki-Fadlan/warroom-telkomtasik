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

# membaca id Tele apakah terdftar atau tidak atau nonaktif
def read_user_status(chat_id):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql = "SELECT st_sf FROM user_sf WHERE id_tele_sf = "+str(chat_id)
    cursor.execute(sql)
    results = cursor.fetchall()
    # return results
    lst_user= ''
    for data in results:
        data = ''.join(str(data))
        lst_user+=data
    return lst_user.replace('(', '').replace(',)','')

def atur_aksi(status,chat_id):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql = "UPDATE user_sf SET aksi_tele_sf=%s WHERE id_tele_sf=%s"
    val = (status, chat_id)
    cursor.execute(sql, val)
    return db.commit()

def cek_aksi(chat_id):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql = "SELECT aksi_tele_sf FROM user_sf WHERE id_tele_sf = "+str(chat_id)
    cursor.execute(sql)
    results = cursor.fetchall()
    # return results
    lst_user= ''
    for data in results:
        data = ''.join(str(data))
        lst_user+=data
    return int(lst_user.replace('(', '').replace(',)',''))

def liststo():
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql = """SELECT nama_sto FROM dm_sto WHERE status_sto = 1"""
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
    sql = "DELETE FROM user_sf_crud_tele WHERE tele_id = "+str(chat_id)
    cursor.execute(sql)
    return db.commit()

def tambahwo(chat_id,username):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql = "INSERT INTO user_sf_crud_tele (`tele_id`, `order_id`, `sto`, `stamp_ampser`, `track_id`, `layanan`, `kecepatan`, `ncp`, `kcp`, `kacp`, `alamat`, `pat_alamat`, `desa`, `kecamatan`, `tikor_odp`, `tikor_cp`, `datel_odp`, `est_pj_dc`, `ket_sales`, `user_sf`) VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)"
    values = [chat_id,"isi","isi","isi","isi","isi","isi","isi","isi","isi","isi","isi","isi","isi","isi","isi","isi","isi","isi","@"+username]
    cursor.execute(sql, values)
    return db.commit()

def cekpengisiandata(chat_id,column):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql = "SELECT "+str(column)+" FROM user_sf_crud_tele WHERE tele_id = "+str(chat_id)
    cursor.execute(sql)
    results = cursor.fetchall()
    # return results
    lst_user= []
    for data in results:
        data = ''.join(data)
        lst_user.append(data)
    if "isi" in lst_user:
        return True
    else :
        return False

def cekidsto(sto):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql ="SELECT id_sto,nama_sto FROM dm_sto"
    cursor.execute(sql)
    results = cursor.fetchall()
    lst_user= []
    for data in results:
        lst_user.append(list(data))
    nilai = ""
    for data in lst_user:
        if sto in data :
            nilai += str(data[0])
    return nilai

def cekidLayanan(layanan):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql ="SELECT id_layanan,nama_layanan FROM dm_layanan WHERE st_ly=1"
    cursor.execute(sql)
    results = cursor.fetchall()
    lst_user= []
    for data in results:
        lst_user.append(list(data))
    nilai = ""
    for data in lst_user:
        if layanan in data :
            nilai += str(data[0])
    return nilai

def cekidKecepatan(kecepatan):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql ="SELECT id_kecepatan,nama_kecepatan FROM dm_kecepatan WHERE st_kc=1"
    cursor.execute(sql)
    results = cursor.fetchall()
    lst_user= []
    for data in results:
        lst_user.append(list(data))
    nilai = ""
    for data in lst_user:
        if kecepatan in data :
            nilai += str(data[0])
    return nilai


def isidata(chat_id,data,column_name):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql = "UPDATE user_sf_crud_tele SET "+str(column_name)+" = %s WHERE tele_id = %s"
    values = [data, chat_id]
    cursor.execute(sql, values)
    return db.commit()

def generate_order_id(sto):
    from datetime import datetime
    dt = datetime.now()
    return sto+"-"+str(datetime.utcnow().strftime('%F %T.%f')).replace("-","").replace(":","").replace(" ","").replace(".","")[2:16]

def kb_layanan():
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql = """SELECT nama_layanan FROM dm_layanan WHERE st_ly = 1"""
    # SELECT nama_layanan FROM `dm_layanan` WHERE st_ly = 1
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

def kb_kecepatan():
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql = """SELECT nama_kecepatan FROM dm_kecepatan WHERE st_kc = 1"""
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


def hasilinput(chat_id):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql ="""SELECT * FROM user_sf_crud_tele LEFT JOIN dm_sto ON user_sf_crud_tele.sto = dm_sto.id_sto LEFT JOIN dm_layanan ON user_sf_crud_tele.layanan = dm_layanan.id_layanan LEFT JOIN dm_kecepatan ON user_sf_crud_tele.kecepatan = dm_kecepatan.id_kecepatan WHERE tele_id = """+str(chat_id)
    cursor.execute(sql)
    results = cursor.fetchall()
    hasil_data = list(results[0])
    pesan = "Berikut merupakan hasil inputan anda:"
    pesan += "\nOrder ID : " + str(hasil_data[2])
    pesan += "\nTrack ID : " + str(hasil_data[5])
    pesan += "\nSTO : " + str(hasil_data[22])
    pesan += "\nLayanan : " + str(hasil_data[26])
    pesan += "\nKecepatan : " + str(hasil_data[29])
    pesan += "\nNama : " + str(hasil_data[8])
    pesan += "\nKontak : " + str(hasil_data[9])
    pesan += "\nKontak Alternatif : " + str(hasil_data[10])
    pesan += "\nAlamat  : " + str(hasil_data[11])
    pesan += "\nPatokan Alamat  : " + str(hasil_data[12])
    pesan += "\nDesa  : " + str(hasil_data[13])
    pesan += "\nKecamatan  : " + str(hasil_data[14])
    pesan += "\nTitik ODP  : " + str(hasil_data[15]).replace("$$$",",")
    pesan += "\nTitik Pelanggan  : " + str(hasil_data[16]).replace("$$$",",")
    pesan += "\nDatek ODP  : " + str(hasil_data[17])
    pesan += "\nEstimasi Panjang DC  : " + str(hasil_data[18])
    pesan += "\nKeterangan  : " + str(hasil_data[19])
    return pesan

def cekhp(id):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm",
  raise_on_warnings = True
)
    cursor = db.cursor()
    sql = "SELECT kcp FROM all_wo "
    sqlt = "SELECT kacp FROM all_wo "
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
    
    if id in lst_user:
        return lst_user.index(id)+1
    else :
        return 0

def cekidUser(tele_id):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql ="SELECT id_sf,id_tele_sf FROM user_sf "
    cursor.execute(sql)
    results = cursor.fetchall()
    lst_user= []
    for data in results:
        lst_user.append(list(data))
    nilai = ""
    for data in lst_user:
        if tele_id in data :
            nilai += str(data[0])
    return nilai

def pindahdata(chat_id,stamp_amser):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql = "SELECT * FROM user_sf_crud_tele WHERE tele_id = "+str(chat_id)
    cursor.execute(sql)
    results = cursor.fetchall()
    # return results
    lst_user= []
    for data in results:
        data = ''.join(str(data))
        lst_user.append(data)
    lst_user = str(lst_user).replace('["(',"").replace(')"]','').replace("'","").replace(', ',',')
    datafinal =list(lst_user.split(","))
    sql = "INSERT INTO all_wo (order_id, sto, stamp_ampser, track_id, layanan, kecepatan, ncp, kcp, kacp, alamat, pat_alamat, desa, kecamatan, tikor_odp, tikor_cp, datel_odp, est_pj_dc, ket_sales, user_sf, sf_id,st_wo) VALUES ( %s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)"
    values = [datafinal[2],datafinal[3],stamp_amser,datafinal[5],datafinal[6],datafinal[7],datafinal[8],datafinal[9],datafinal[10],datafinal[11],datafinal[12],datafinal[13],datafinal[14],datafinal[15], datafinal[16],datafinal[17],datafinal[18],datafinal[19],datafinal[20],cekidUser(datafinal[1]),1]
    cursor.execute(sql, values)
    db.commit()
    sql = "DELETE FROM user_sf_crud_tele WHERE tele_id = "+str(chat_id)
    cursor.execute(sql)
    return db.commit()

def cekUserInput(tele_id):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql ="SELECT id,tele_id FROM user_sf_crud_tele WHERE tele_id = "+str(tele_id)
    cursor.execute(sql)
    results = cursor.fetchall()
    lst_user= []
    for data in results:
        lst_user.append(list(data))
    nilai = ""
    for data in lst_user:
        if tele_id in data :
            nilai += str(data[0])
    return nilai

def isiLogData(waktu,chat_id,username,aksiUser,userMsg,responBot):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql = "INSERT INTO user_sf_log_bot (waktu_akses, id_tele, username_tele, aksi_user, user_msg, bot_msg) VALUES ( %s,%s,%s,%s,%s,%s)"
    values = [waktu,chat_id,username,aksiUser,userMsg,responBot]
    cursor.execute(sql, values)
    return db.commit()


def alldatainput(chat_id):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql ="""SELECT order_id FROM all_wo WHERE sf_id = """+str(cekidUser(chat_id))
    cursor.execute(sql)
    results = cursor.fetchall()
    hasil_data = list(results[0:])
    pesan = "\nTerdeteksi sebanyak "+str(len(hasil_data))+" Order-ID yang telah anda Input. Berikut Merupakan Order ID WO yang telah anda input:"
    no = 1
    for data in hasil_data:
        pesan += "\n"+str(no)+". "+str(data).replace("('", '').replace('\',)','')
        no +=1
    if(len(hasil_data)==0):
        return "Terdeteksi sebanyak "+str(len(hasil_data))+" Order-ID yang telah anda Input"
    else:
        return pesan
        
def statuswo(order_id,username):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql ="SELECT * FROM all_wo"
    cursor.execute(sql)
    results = cursor.fetchall()

    hasil_data = list(results)

    pesan = ""

    for data in hasil_data:
        if(list(data)[1]==order_id):
            wo_Data = []
            for val in list(data):
                if(val==None):
                    wo_Data.append('Belum Ada')
                else:
                    wo_Data.append(val)
            pesan+= "\nHallo Komandan "+username+", berikut merupakan data untuk Order-ID "+wo_Data[1]
            pesan+= "\n\nTgl Input :"+wo_Data[3]
            pesan+= "\nTrack ID :"+wo_Data[4]
            pesan+= "\nNama Pelanggan : "+wo_Data[7]
            pesan+= "\nAlamat :"+wo_Data[10]
            pesan+= "\nK-Contact Sales : "+str(wo_Data[20])
            pesan+= "\nTgl Validasi : "+wo_Data[21]
            pesan+= "\nStatus Validasi : "+str(wo_Data[22])
            pesan+= "\nKetarangan Validator : "+str(wo_Data[26])
            pesan+= "\nStatus FCC : "+str(wo_Data[23])
            pesan+= "\nTeknisi : "  +wo_Data[28]
            pesan+= "\nStatusWO : "+wo_Data[53] 
            pesan+= "\nKet ODP: " +wo_Data[28]
            pesan+= "\nNo SC : "+wo_Data[33]
            pesan+= "\nNo Inet : "+wo_Data[34]
            pesan+= "\nTgl PS : "+wo_Data[34]

    if len(pesan)>0:
        return pesan
    else:
        return "Order-ID yang anda berikan tidak ditemukan"
def cariSalesdata(id):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql ="SELECT * FROM user_sf WHERE id_sf='"+str(id)+"'"
    cursor.execute(sql)
    results = cursor.fetchall()
    ps="\nSales : "+list(results[0])[3]
    ps+="\nKcontact : "+list(results[0])[5]
    return ps

def cariTeknisiData(id):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql ="SELECT * FROM user_teknisi WHERE id_teknisi='"+str(id)+"'"
    cursor.execute(sql)
    results = cursor.fetchall()
    ps="\nTeknisi : "+list(results[0])[4]
    ps+="\nNo.Teknisi : "+list(results[0])[5]
    ps+="\nTele.Teknisi : "+list(results[0])[3]
    return ps

def cariValidasi(id):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql ="SELECT n_validasi FROM dm_validasi WHERE id_validasi='"+str(id)+"'"
    cursor.execute(sql)
    results = cursor.fetchall()
    return list(results[0])[0]
def cariFCC(id):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql ="SELECT n_fcc FROM dm_fcc WHERE id_fcc='"+str(id)+"'"
    cursor.execute(sql)
    results = cursor.fetchall()
    return list(results[0])[0]
def carist_wo(id):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql ="SELECT n_st_wo FROM dm_wo_st WHERE id_st_wo='"+str(id)+"'"
    cursor.execute(sql)
    results = cursor.fetchall()
    return list(results[0])[0]
def cariKendala(id):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql ="SELECT n_tipe_kendala FROM dm_kendala WHERE id_kendala='"+str(id)+"'"
    cursor.execute(sql)
    results = cursor.fetchall()
    return list(results[0])[0]

        
def detilWO(order_id,username):
    db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="db_sisfowtsm"
)
    cursor = db.cursor()
    sql ="SELECT * FROM all_wo WHERE order_id='"+str(order_id)+"'"
    cursor.execute(sql)
    results = cursor.fetchall()
    if(len(results)<1):
        return "Mon Maaf Komandan "+username+",Order ID Yang anda berikan Tidak Ditemukan"
    else:
        import datetime
        hasil_data = list(results[0])
        hasil_data = ['None' if x is None else x for x in hasil_data]

        pesan = ""

        pesan+= "Hallo Komandan "+username+", berikut merupakan data untuk Order-ID "+str(hasil_data[1])
        pesan+= "\n\nTgl Input : "+str(datetime.datetime.fromtimestamp(int(hasil_data[3])).strftime('%d-%m-%Y %H:%M:%S'))
        pesan+= "\nTrack ID : "+str(hasil_data[4])
        pesan+= "\nNama Pelanggan : "+str(hasil_data[7])
        pesan+= "\nAlamat :"+str(hasil_data[10])
        pesan+= "\nTele.SF :"+str(hasil_data[19])
        pesan+= cariSalesdata(hasil_data[20])
        if(str(hasil_data[21])=="None"):
            pesan+= "\nTgl Validasi: Belum Validasi"
            pesan+= "\nStatus Validasi : Belum Validasi"
            pesan+= "\nStatus FCC : Belum Validasi"
        else:
            pesan+= "\nTgl Validasi : "+str(datetime.datetime.fromtimestamp(int(hasil_data[21])).strftime('%d-%m-%Y %H:%M:%S'))
            pesan+= "\nStatus Validasi : "+str(cariValidasi(int(hasil_data[22])))
            pesan+= "\nStatus FCC : "+cariFCC(int(hasil_data[23]))
            pesan+= "\nKetarangan Validator : "+str(hasil_data[25])


        if(str(hasil_data[29])=="None"):
            pesan+= "\nTeknisi: Tidak Ada"
        else:
            pesan+= cariTeknisiData(hasil_data[29])

        pesan+= "\nKet ODP : " +str(hasil_data[-15])
        pesan+= "\nNo SC : "+str(hasil_data[-22])
        pesan+= "\nNo Inet : "+str(hasil_data[-21])
        if(str(hasil_data[-17])=="None"):
            pesan+= "\nTgl PS : Belum Ada"
        else:
            pesan+= "\nTgl PS : "+str(datetime.datetime.fromtimestamp(int(hasil_data[-18])).strftime('%d-%m-%Y %H:%M:%S'))
        pesan+= "\nStatusWO : "+str(carist_wo(int(hasil_data[-1])))
        if(int(hasil_data[-1])==4):
            pesan+= "\nKeterangan Teknisi : "+str(hasil_data[-5])
            if(hasil_data[-4]!="None"):
                pesan+= "\nTipe Kendala : "+str(cariKendala(int(hasil_data[-4])))
                if(int(hasil_data[-4])==6 or int(hasil_data[-4])==7):
                    pesan+= "\nODP : "+str(hasil_data[-14])
        return pesan
