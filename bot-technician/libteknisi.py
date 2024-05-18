from unittest import result
import mysql.connector
import functools
from telegram import KeyboardButton, ReplyKeyboardMarkup, ReplyKeyboardRemove, __version__ as TG_VER


def statusteknisi(chat_id):
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        passwd="",
        database="db_sisfowtsm",
        raise_on_warnings=True
    )
    cursor = db.cursor()
    sql = "SELECT st_tek FROM user_teknisi WHERE id_tele_tek = "+str(chat_id)
    cursor.execute(sql)
    results = cursor.fetchall()
    if (len(results) == 1):
        for data in results:
            if (int(str(data).replace(',', '').replace('(', '').replace(')', '')) == 1):
                return True
            else:
                return False
    else:
        return False


def kbOrder_id(chat_id):
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        passwd="",
        database="db_sisfowtsm",
        raise_on_warnings=True
    )
    cursor = db.cursor()
    sql = "SELECT id_teknisi FROM user_teknisi WHERE id_tele_tek = " + \
        str(chat_id)
    cursor.execute(sql)
    results = cursor.fetchall()
    # ID Teknisi
    id_teknisi = 0
    for data in results:
        id_teknisi += int(str(data).replace(',',
                          '').replace('(', '').replace(')', ''))
    sql = "SELECT order_id FROM all_wo WHERE st_wo=8 AND id_nama_teknisi = " + \
        str(id_teknisi)
    cursor.execute(sql)
    results = cursor.fetchall()
    kb = []
    # kbmenu = [[KeyboardButton("PROSES WO")],[KeyboardButton("LISTWO")]]
    for data in results:
        kb.append([KeyboardButton(str(data).replace(',', '').replace(
            '(', '').replace(')', '').replace('\'', ''))])
        # kb.append(str(data).replace(',','').replace('(','').replace(')','').replace('\'',''))
    return kb


def kbKendala():
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        passwd="",
        database="db_sisfowtsm",
        raise_on_warnings=True
    )
    cursor = db.cursor()
    sql = "SELECT n_tipe_kendala FROM dm_kendala"
    cursor.execute(sql)
    results = cursor.fetchall()
    kb = []
    # kbmenu = [[KeyboardButton("PROSES WO")],[KeyboardButton("LISTWO")]]
    x = 0
    for data in results:
        if ((x != 2) and (x != 4) and (x != 5) and (x != 6) and (x != 3)):
            kb.append([KeyboardButton(str(data).replace(',', '').replace(
                '(', '').replace(')', '').replace('\'', ''))])
            # kb.append(str(data).replace(',','').replace('(','').replace(')','').replace('\'',''))
        x += 1
    return kb


def cekKbKendala(kendala):
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        passwd="",
        database="db_sisfowtsm",
        raise_on_warnings=True
    )
    cursor = db.cursor()
    sql = "SELECT n_tipe_kendala FROM dm_kendala"
    cursor.execute(sql)
    results = cursor.fetchall()
    kb = []
    for data in results:
        kb.append(str(data).replace(',', '').replace(
            '(', '').replace(')', '').replace('\'', ''))
    if kendala in kb:
        return (kb.index(kendala))+1
    else:
        return False


def cekIdKendala(chat_id):
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        passwd="",
        database="db_sisfowtsm",
        raise_on_warnings=True
    )
    cursor = db.cursor()
    sql = "SELECT alamat_inst_tpken_ft FROM user_teknisi_crud_tele WHERE tele_id_ft = " + \
        str(chat_id)
    cursor.execute(sql)
    results = cursor.fetchall()
    for data in results:
        return int(str(data).replace(',', '').replace('(', '').replace(')', '').replace('\'', ''))


def cekOrderIdTeknisi(chat_id, order_id):
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        passwd="",
        database="db_sisfowtsm",
        raise_on_warnings=True
    )
    cursor = db.cursor()
    sql = "SELECT id_teknisi FROM user_teknisi WHERE id_tele_tek = " + \
        str(chat_id)
    cursor.execute(sql)
    results = cursor.fetchall()
    # ID Teknisi
    id_teknisi = 0
    for data in results:
        id_teknisi += int(str(data).replace(',',
                          '').replace('(', '').replace(')', ''))
    sql = "SELECT order_id FROM all_wo WHERE id_nama_teknisi = " + \
        str(id_teknisi)
    cursor.execute(sql)
    results = cursor.fetchall()
    kb = []
    for data in results:
        kb.append(str(data).replace(',', '').replace(
            '(', '').replace(')', '').replace('\'', ''))
    if order_id in kb:
        return True
    else:
        return False


def read_aksi_teknisi(chat_id):
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        passwd="",
        database="db_sisfowtsm",
        raise_on_warnings=True
    )
    cursor = db.cursor()
    sql = "SELECT aksi_tele_tek FROM user_teknisi WHERE id_tele_tek = " + \
        str(chat_id)
    cursor.execute(sql)
    results = cursor.fetchall()
    for data in results:
        return int(str(data).replace(',', '').replace('(', '').replace(')', ''))


def atur_aksi(chat_id, status):
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        passwd="",
        database="db_sisfowtsm"
    )
    cursor = db.cursor()
    sql = "UPDATE user_teknisi SET aksi_tele_tek=%s WHERE id_tele_tek=%s"
    val = (status, chat_id)
    cursor.execute(sql, val)
    return db.commit()


def to_crud(chat_id, col_name, value_col):
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        passwd="",
        database="db_sisfowtsm"
    )
    cursor = db.cursor()
    sql = "UPDATE user_teknisi_crud_tele SET " + \
        str(col_name)+"= %s WHERE tele_id_ft=%s"
    val = [value_col, chat_id]
    cursor.execute(sql, val)
    return db.commit()


def cek_crud(chat_id):
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        passwd="",
        database="db_sisfowtsm"
    )
    cursor = db.cursor()
    sql = "SELECT tele_id_ft FROM user_teknisi_crud_tele WHERE tele_id_ft = " + \
        str(chat_id)
    cursor.execute(sql)
    results = cursor.fetchall()
    if (len(results) == 1):
        return True
    else:
        return False


def add_to_crud(chat_id, order_id, status):
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        passwd="",
        database="db_sisfowtsm"
    )
    cursor = db.cursor()
    sql = "INSERT INTO user_teknisi_crud_tele (tele_id_ft,order_id_ft,st_wo_ft) VALUES (%s,%s,%s)"
    values = [chat_id, order_id, status]
    cursor.execute(sql, values)
    return db.commit()


def destroysesion(chat_id):
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        passwd="",
        database="db_sisfowtsm"
    )
    cursor = db.cursor()
    sql = "DELETE FROM user_teknisi_crud_tele WHERE tele_id_ft = "+str(chat_id)
    cursor.execute(sql)
    return db.commit()


def cekpengisiandata(chat_id, col_name):
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        passwd="",
        database="db_sisfowtsm"
    )
    cursor = db.cursor()
    sql = "SELECT " + \
        str(col_name)+" FROM user_teknisi_crud_tele WHERE tele_id_ft = "+str(chat_id)
    cursor.execute(sql)
    results = cursor.fetchall()
    for data in results:
        if (list(data)[0] == None):
            return False
        else:
            return True


def tambahanDetilWo(order_id):
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        passwd="",
        database="db_sisfowtsm"
    )
    cursor = db.cursor()
    sql = 'SELECT track_id,ncp FROM all_wo WHERE order_id = "' + \
        str(order_id)+'"'
    cursor.execute(sql)
    results = cursor.fetchall()
    hasil_data = list(results[0])
    return hasil_data


def inputSummary(chat_id):
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        passwd="",
        database="db_sisfowtsm"
    )
    cursor = db.cursor()
    sql = """SELECT * FROM user_teknisi_crud_tele WHERE tele_id_ft = """ + \
        str(chat_id)
    cursor.execute(sql)
    results = cursor.fetchall()
    hasil_data = list(results[0])
    pesan = "Berikut merupakan hasil Feedback anda:"
    if (hasil_data[17] == 3):
        pesan += "\nOrder ID : " + str(hasil_data[2])
        pesan += "\Track ID : " + str(tambahanDetilWo(str(hasil_data[2]))[0])
        pesan += "\nNama Cal.Pelanggan : " + \
            str(tambahanDetilWo(str(hasil_data[2]))[1])
        pesan += "\nAlamat Instalasi : " + str(hasil_data[3])
        pesan += "\nODP : " + str(hasil_data[14])
        pesan += "\nContact Person : " + str(hasil_data[4])
        pesan += "\nTikor Pelanggan : " + \
            str(hasil_data[5]).replace("$$$", ",")
        pesan += "\nPort : " + str(hasil_data[6])
        pesan += "\nQR : " + str(hasil_data[7])
        pesan += "\nPanjang DC : " + str(hasil_data[8])
        pesan += "\nSN ONT : " + str(hasil_data[9])
        pesan += "\nSN STB : " + str(hasil_data[10])
        pesan += "\nID Valins : " + str(hasil_data[11])
        pesan += "\nUser Crew : " + str(hasil_data[12])
        pesan += "\nApp Sektor : " + str(hasil_data[13])
        pesan += "\nKeterangan : " + str(hasil_data[15])
        return pesan
    else:
        if (int(hasil_data[3]) == 6 or int(hasil_data[3]) == 7):
            sql = """SELECT n_tipe_kendala  FROM dm_kendala WHERE id_kendala = """ + \
                str(hasil_data[3])
            cursor.execute(sql)
            results = cursor.fetchall()
            hasil_datas = list(results[0])
            pesan += "\nOrder ID : " + str(hasil_data[2])
            pesan += "\nTipe Kendala : " + str(hasil_datas[0])
            pesan += "\nODP : " + str(hasil_data[14])
            pesan += "\nKeterangan : " + str(hasil_data[15])
            return pesan
        elif (int(hasil_data[3]) == 4):
            sql = """SELECT n_tipe_kendala  FROM dm_kendala WHERE id_kendala = """ + \
                str(hasil_data[3])
            cursor.execute(sql)
            results = cursor.fetchall()
            hasil_datas = list(results[0])
            pesan += "\nOrder ID : " + str(hasil_data[2])
            pesan += "\nTipe Kendala : " + str(hasil_datas[0])
            pesan += "\nNo.HP Pelanggan : " + str(hasil_data[4])
            pesan += "\nTikor Pelanggan : " + \
                str(hasil_data[5]).replace("$$$", ",")
            pesan += "\nTanggal Janji : " + str(hasil_data[6])
            pesan += "\nKeterangan : " + str(hasil_data[15])
            return pesan
        else:
            sql = """SELECT n_tipe_kendala  FROM dm_kendala WHERE id_kendala = """ + \
                str(hasil_data[3])
            cursor.execute(sql)
            results = cursor.fetchall()
            hasil_datas = list(results[0])
            pesan += "\nOrder ID : " + str(hasil_data[2])
            pesan += "\nTipe Kendala : " + str(hasil_datas[0])
            pesan += "\nTikor Pelanggan : " + \
                str(hasil_data[5]).replace("$$$", ",")
            pesan += "\nKeterangan : " + str(hasil_data[15])
            return pesan


def pindahData(chat_id):
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        passwd="",
        database="db_sisfowtsm"
    )
    cursor = db.cursor()
    sql = """SELECT * FROM user_teknisi_crud_tele WHERE tele_id_ft = """ + \
        str(chat_id)
    cursor.execute(sql)
    results = cursor.fetchall()
    hasil_data = list(results[0])
    orderid = str(hasil_data[2])
    alm = str(hasil_data[3])
    odp = str(hasil_data[14])
    ncp = str(hasil_data[4])
    tikor = str(hasil_data[5])
    port = str(hasil_data[6])
    qr = str(hasil_data[7])
    pjdc = str(hasil_data[8])
    snont = str(hasil_data[9])
    snstb = str(hasil_data[10])
    idval = str(hasil_data[11])
    usercrew = str(hasil_data[12])
    appsektor = str(hasil_data[13])
    keterangan = str(hasil_data[15])
    waktu = str(hasil_data[16])
    status = hasil_data[17]
    if (status == 3):
        sql = "UPDATE all_wo SET alamat_inst='"+str(alm)+"',no_plgn='"+str(ncp)+"',odp='"+str(odp)+"',tikor_plgn='"+str(tikor)+"',port='"+str(port)+"',qr='"+str(qr)+"',pnj_dc='"+str(pjdc)+"',snont='"+str(snont)+"',snstb='"+str(
            snstb)+"',id_vallins='"+str(idval)+"',user_crew='"+str(usercrew)+"',app_sektor='"+str(appsektor)+"',ket_teknisi='"+str(keterangan)+"',wf_teknisi='"+str(waktu)+"',st_wo='"+str(status)+"' WHERE all_wo.order_id = '"+str(orderid)+"'"
        cursor.execute(sql)
        return db.commit()
    else:
        if (int(alm) == 6 or int(alm) == 7):
            sql = "UPDATE all_wo SET tp_kendala='"+str(alm)+"',odp='"+str(odp)+"',ket_teknisi='"+str(
                keterangan)+"',wf_teknisi='"+str(waktu)+"',st_wo='"+str(status)+"' WHERE all_wo.order_id = '"+str(orderid)+"'"
            cursor.execute(sql)
            return db.commit()
        if (int(alm) == 4):
            sql = "UPDATE all_wo SET tp_kendala='"+str(alm)+"',no_plgn='"+str(ncp)+"',tikor_plgn='"+str(tikor)+"',manja_date='"+str(
                port)+"',ket_teknisi='"+str(keterangan)+"',wf_teknisi='"+str(waktu)+"',st_wo='"+str(status)+"' WHERE all_wo.order_id = '"+str(orderid)+"'"
            cursor.execute(sql)
            return db.commit()
        else:
            sql = "UPDATE all_wo SET tp_kendala='"+str(alm)+"',tikor_plgn='"+str(tikor)+"',ket_teknisi='"+str(
                keterangan)+"',wf_teknisi='"+str(waktu)+"',st_wo='"+str(status)+"' WHERE all_wo.order_id = '"+str(orderid)+"'"
            cursor.execute(sql)
            return db.commit()


def listWoKu(chat_id):
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        passwd="",
        database="db_sisfowtsm",
        raise_on_warnings=True
    )
    cursor = db.cursor()
    sql = "SELECT id_teknisi FROM user_teknisi WHERE id_tele_tek = " + \
        str(chat_id)
    cursor.execute(sql)
    results = cursor.fetchall()
    # ID Teknisi
    id_teknisi = 0
    for data in results:
        id_teknisi += int(str(data).replace(',',
                          '').replace('(', '').replace(')', ''))
    sql = "SELECT order_id,st_wo FROM all_wo WHERE id_nama_teknisi = " + \
        str(id_teknisi)
    cursor.execute(sql)
    results = cursor.fetchall()
    kb = []
    # kbmenu = [[KeyboardButton("PROSES WO")],[KeyboardButton("LISTWO")]]
    for data in results:
        # kb.append([KeyboardButton(str(data).replace(',','').replace('(','').replace(')','').replace('\'',''))])
        kb.append(str(data).replace(',', '').replace(
            '(', '').replace(')', '').replace('\'', ''))
    myWo = "Berikut Merupakan List WO Kamu:"
    no = 0
    for data in kb:
        no += 1
        listwo = data.split(' ')
        sql = "SELECT n_st_wo FROM dm_wo_st WHERE id_st_wo="+str(listwo[1])
        cursor.execute(sql)
        results = cursor.fetchall()
        for data in results:
            if (no == 150):
                return myWo
            myWo += "\n"+str(no)+". "+listwo[0]+" ("+str(data).replace(
                ',', '').replace('(', '').replace(')', '').replace('\'', '')+")"

    return myWo
