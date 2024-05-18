import re
from telegram import Update
from telegram.ext import filters, MessageHandler, ApplicationBuilder, CommandHandler, ContextTypes, CallbackContext, CallbackQueryHandler
from tabnanny import check
from turtle import up
from operator import index
import libteknisi
from dotenv import load_dotenv
import os
from telegram import KeyboardButton, ReplyKeyboardMarkup, ReplyKeyboardRemove, __version__ as TG_VER
from telegram import InlineKeyboardButton, InlineKeyboardMarkup, Update
from datetime import datetime
load_dotenv()
now = datetime.now()
sekarang = now.strftime("%d-%m-%Y %H:%M:%S")
BOT_TOKEN = os.getenv("TOKEN_BOT_TECHNICIAN_DEV")
kbproses = [[KeyboardButton("BISA DITARIK PT1")], [KeyboardButton("KENDALA")], [
    KeyboardButton("WO MANJA")]]
kbmenu = [[KeyboardButton("PROSES WO")], [KeyboardButton("LISTWO")]]


async def start(update: Update, context: ContextTypes.DEFAULT_TYPE) -> None:
    chat_id = update.effective_chat.id
    usernametele = update.effective_user.username
    if (libteknisi.statusteknisi(chat_id) == True):
        await context.bot.send_message(chat_id=update.effective_chat.id, text=usernametele+" ID Telegram anda telah terdaftar, Silahkan pilih menu yang tersedia!", reply_markup=ReplyKeyboardMarkup(kbmenu))
    else:
        await context.bot.send_message(chat_id=update.effective_chat.id, text="Anda tidak terdaftar sebagai Sales Force, mohon hubungi admin.", reply_markup=ReplyKeyboardRemove())


async def echo(update: Update, context: ContextTypes.DEFAULT_TYPE) -> None:
    kbKonfirmasi = [[InlineKeyboardButton('Ya', callback_data='pindah')], [
        InlineKeyboardButton('Tidak', callback_data='jangan')]]
    chat_id = update.effective_chat.id
    usernametele = update.effective_user.username
    if (libteknisi.statusteknisi(chat_id) == True):
        if (update.message.text.replace('"', ' ').replace("'", '').replace(",", '.').upper() == "BISA DITARIK PT1"):
            if (len(libteknisi.kbOrder_id(chat_id)) > 0):
                libteknisi.destroysesion(chat_id)
                libteknisi.atur_aksi(chat_id, 2)
                await context.bot.send_message(chat_id=update.effective_chat.id, text="Silahkan Pilih Order-ID nya", reply_markup=ReplyKeyboardMarkup(libteknisi.kbOrder_id(chat_id), resize_keyboard=True))
            else:
                await context.bot.send_message(chat_id=update.effective_chat.id, text="Saat ini tidak ada WO yang di dispatch kepada anda", reply_markup=ReplyKeyboardMarkup(kbmenu))
        elif (update.message.text.replace('"', ' ').replace("'", '').replace(",", '.').upper() == "KENDALA"):
            if (len(libteknisi.kbOrder_id(chat_id)) > 0):
                libteknisi.destroysesion(chat_id)
                libteknisi.atur_aksi(chat_id, 1)
                await context.bot.send_message(chat_id=update.effective_chat.id, text="Silahkan Pilih Order-ID nya", reply_markup=ReplyKeyboardMarkup(libteknisi.kbOrder_id(chat_id), resize_keyboard=True))
            else:
                await context.bot.send_message(chat_id=update.effective_chat.id, text="Saat ini tidak ada WO yang di dispatch kepada anda", reply_markup=ReplyKeyboardMarkup(kbmenu))
        elif (update.message.text.replace('"', ' ').replace("'", '').replace(",", '.').upper() == "WO MANJA"):
            if (len(libteknisi.kbOrder_id(chat_id)) > 0):
                libteknisi.destroysesion(chat_id)
                libteknisi.atur_aksi(chat_id, 3)
                await context.bot.send_message(chat_id=update.effective_chat.id, text="Silahkan Pilih Order-ID nya", reply_markup=ReplyKeyboardMarkup(libteknisi.kbOrder_id(chat_id), resize_keyboard=True))
            else:
                await context.bot.send_message(chat_id=update.effective_chat.id, text="Saat ini tidak ada WO yang di dispatch kepada anda", reply_markup=ReplyKeyboardMarkup(kbmenu))
        elif (update.message.text.replace('"', ' ').replace("'", '').replace(",", '.').upper() == "PROSES WO"):
            libteknisi.destroysesion(chat_id)
            libteknisi.atur_aksi(chat_id, 0)
            await context.bot.send_message(chat_id=update.effective_chat.id, text="Silahkan Pilih Menu dibawah ini", reply_markup=ReplyKeyboardMarkup(kbproses))
        elif (update.message.text.replace('"', ' ').replace("'", '').replace(",", '.').upper() == "LISTWO"):
            libteknisi.destroysesion(chat_id)
            libteknisi.atur_aksi(chat_id, 0)
            await context.bot.send_message(chat_id=update.effective_chat.id, text=libteknisi.listWoKu(chat_id), reply_markup=ReplyKeyboardMarkup(kbmenu))
        elif (update.message.text.replace('"', ' ').replace("'", '').replace(",", '.').upper() == "BATAL"):
            libteknisi.destroysesion(chat_id)
            libteknisi.atur_aksi(chat_id, 0)
            await context.bot.send_message(chat_id=update.effective_chat.id, text="Baik, Silahkan pilih menu yang telah disediakan", reply_markup=ReplyKeyboardMarkup(kbmenu))
        else:
            if (libteknisi.read_aksi_teknisi(chat_id) == 0):
                # Status OFF
                await context.bot.send_message(chat_id=update.effective_chat.id, text="Silahkan pilih menu yang tersedia!", reply_markup=ReplyKeyboardMarkup(kbmenu))
            elif (libteknisi.read_aksi_teknisi(chat_id) == 1):
                # Status Kendala
                if (libteknisi.cek_crud(chat_id) == False):
                    if (libteknisi.cekOrderIdTeknisi(chat_id, update.message.text.replace('"', ' ').replace("'", '').replace(",", '.')) == True):
                        libteknisi.add_to_crud(chat_id, update.message.text.replace(
                            '"', ' ').replace("'", '').replace(",", '.'), 4)
                        await context.bot.send_message(chat_id=update.effective_chat.id, text="Order-ID "+update.message.text.replace('"', ' ').replace("'", '').replace(",", '.').upper()+" telah dipilih, Silahkan Pilih Tipe Kendala", reply_markup=ReplyKeyboardMarkup(libteknisi.kbKendala()))
                    else:
                        await context.bot.send_message(chat_id=update.effective_chat.id, text="Mohon pilih Order-ID Yang telah tersedia", reply_markup=ReplyKeyboardMarkup(libteknisi.kbOrder_id(chat_id)))
                else:
                    if (libteknisi.cekpengisiandata(chat_id, 'alamat_inst_tpken_ft') == False):
                        if (isinstance(libteknisi.cekKbKendala(update.message.text.replace('"', ' ').replace("'", '').replace(",", '.')), int) == True):
                            libteknisi.to_crud(chat_id, 'alamat_inst_tpken_ft', str(libteknisi.cekKbKendala(
                                update.message.text.replace('"', ' ').replace("'", '').replace(",", '.'))))
                            await context.bot.send_message(chat_id=update.effective_chat.id, text="Tipe Kendala telah diisi, , silahkan masukan  Tikor Pelanggan.\nAnda bisa menggunakan fitur Shareloc untuk mendapatkan memasukan Koordinat!!", reply_markup=ReplyKeyboardRemove())
                        else:
                            await context.bot.send_message(chat_id=update.effective_chat.id, text="Mohon pilih tipe Kendala yang telah disediakan!!", reply_markup=ReplyKeyboardMarkup(libteknisi.kbKendala()))
                    else:
                        if (libteknisi.cekpengisiandata(chat_id, 'tikor_cp_ft') == False):
                            regex = r"-?\d+\.\d+,-?\d+\.\d+"
                            matches = re.search(regex, update.message.text.replace(
                                '"', ' ').replace("'", ''))
                            if matches:
                                libteknisi.to_crud(chat_id, 'tikor_cp_ft', str(
                                    update.message.text.replace('"', ' ').replace("'", '').replace(",", '$$$')))
                                await context.bot.send_message(chat_id, text="Tikor Calon Pelanggan telah ditambahkan, Silahkan Masukan Keterangan", reply_markup=ReplyKeyboardMarkup([[KeyboardButton("Batal")]], resize_keyboard=True))
                            else:
                                await context.bot.send_message(chat_id=update.effective_chat.id, text="Mohon Masukan Tikor dengan format: Latitude,Longitude\nContoh: -7.324324,108.234324")
                        else:
                            if (libteknisi.cekpengisiandata(chat_id, 'keterangan_f_tek') == False):
                                libteknisi.to_crud(chat_id, 'keterangan_f_tek', str(
                                    update.message.text.replace('"', ' ').replace("'", '').replace(",", '.')))
                                from datetime import datetime
                                dt = datetime.today()  # Get timezone naive now
                                sekarang = round(dt.timestamp())-25200
                                libteknisi.to_crud(
                                    chat_id, 'wkt_ft', str(sekarang))
                                await context.bot.send_message(chat_id=update.effective_chat.id, text=libteknisi.inputSummary(chat_id), reply_markup=InlineKeyboardMarkup(kbKonfirmasi))
                            else:
                                await context.bot.send_message(chat_id=update.effective_chat.id, text="Mohon Respon Tombol Konfirmasi (YA/TIDAK)", reply_markup=ReplyKeyboardMarkup(kbmenu))

            elif (libteknisi.read_aksi_teknisi(chat_id) == 2):
                # Status Progress
                if (libteknisi.cek_crud(chat_id) == False):
                    if (libteknisi.cekOrderIdTeknisi(chat_id, update.message.text.replace('"', ' ').replace("'", '').replace(",", '.')) == True):
                        libteknisi.add_to_crud(chat_id, update.message.text.replace(
                            '"', ' ').replace("'", '').replace(",", '.'), 3)
                        await context.bot.send_message(chat_id=update.effective_chat.id, text="Order-ID "+update.message.text.replace('"', ' ').replace("'", '').replace(",", '.').upper()+" telah dipilih, Silahkan Masukan alamat Instalasi!!", reply_markup=ReplyKeyboardRemove())
                    else:
                        await context.bot.send_message(chat_id=update.effective_chat.id, text="Mohon pilih Order-ID Yang telah tersedia", reply_markup=ReplyKeyboardMarkup(libteknisi.kbOrder_id(chat_id), resize_keyboard=True))
                else:
                    if (libteknisi.cekpengisiandata(chat_id, 'alamat_inst_tpken_ft') == False):
                        libteknisi.to_crud(chat_id, 'alamat_inst_tpken_ft', str(
                            update.message.text.replace('"', ' ').replace("'", '').replace(",", '.')))
                        await context.bot.send_message(chat_id=update.effective_chat.id, text="Alamat telah diisi, Silahkan masukan Nomor Pelanggan!!")
                    else:
                        if (libteknisi.cekpengisiandata(chat_id, 'no_plg_ft') == False):
                            if (update.message.text.replace('"', ' ').replace("'", '').replace(",", '.').isnumeric() == True):
                                libteknisi.to_crud(chat_id, 'no_plg_ft', str(
                                    update.message.text.replace('"', ' ').replace("'", '').replace(",", '.')))
                                await context.bot.send_message(chat_id=update.effective_chat.id, text="Nomor hape "+str(update.message.text.replace('"', ' ').replace("'", '').replace(",", '.'))+" Telah ditambahkan, silahkan masukan  Tikor Pelanggan.\nAnda bisa menggunakan fitur Shareloc untuk mendapatkan memasukan Koordinat!!")
                            else:
                                await context.bot.send_message(chat_id=update.effective_chat.id, text="Mohon masukan nomor Hape dengan benar")
                        else:
                            if (libteknisi.cekpengisiandata(chat_id, 'tikor_cp_ft') == False):
                                regex = r"-?\d+\.\d+,-?\d+\.\d+"
                                matches = re.search(regex, update.message.text.replace(
                                    '"', ' ').replace("'", ''))
                                if matches:
                                    libteknisi.to_crud(chat_id, 'tikor_cp_ft', str(
                                        update.message.text.replace('"', ' ').replace("'", '').replace(",", '$$$')))
                                    await context.bot.send_message(chat_id, text="Tikor Calon Pelanggan telah ditambahkan, Silahkan Masukan Datek ODP!!", reply_markup=ReplyKeyboardMarkup([[KeyboardButton("Batal")]], resize_keyboard=True))
                                else:
                                    await context.bot.send_message(chat_id=update.effective_chat.id, text="Mohon Masukan Nama Tikor dengan format: Latitude,Longitude\nContoh:-7.324324,108.234324")
                            else:
                                if (libteknisi.cekpengisiandata(chat_id, 'port_ft') == False):
                                    libteknisi.to_crud(chat_id, 'port_ft', str(
                                        update.message.text.replace('"', ' ').replace("'", '').replace(",", '.')))
                                    await context.bot.send_message(chat_id=update.effective_chat.id, text="Port "+str(update.message.text.replace('"', ' ').replace("'", '').replace(",", '.'))+" Telah ditambahkan, silahkan masukan QR")
                                else:
                                    if (libteknisi.cekpengisiandata(chat_id, 'qr_ft') == False):
                                        libteknisi.to_crud(chat_id, 'qr_ft', str(
                                            update.message.text.replace('"', ' ').replace("'", '').replace(",", '.')))
                                        await context.bot.send_message(chat_id=update.effective_chat.id, text="QR "+str(update.message.text.replace('"', ' ').replace("'", '').replace(",", '.'))+" Telah ditambahkan, silahkan masukan Panjang DC")
                                    else:
                                        if (libteknisi.cekpengisiandata(chat_id, 'pj_dc_ft') == False):
                                            if (update.message.text.replace('"', ' ').replace("'", '').replace(",", '.').isnumeric() == True):
                                                libteknisi.to_crud(chat_id, 'pj_dc_ft', str(
                                                    update.message.text.replace('"', ' ').replace("'", '').replace(",", '.')))
                                                await context.bot.send_message(chat_id=update.effective_chat.id, text="Panjang DC "+str(update.message.text.replace('"', ' ').replace("'", '').replace(",", '.'))+" Telah ditambahkan, silahkan masukan SN ONT")
                                            else:
                                                await context.bot.send_message(chat_id=update.effective_chat.id, text="Tolong masukan Panjang DC dengan Angka dalam satuan meter, Contoh jika panjang DC 8 Meter maka kirim angka 8")
                                        else:
                                            if (libteknisi.cekpengisiandata(chat_id, 'snont_ft') == False):
                                                libteknisi.to_crud(chat_id, 'snont_ft', str(
                                                    update.message.text.replace('"', ' ').replace("'", '').replace(",", '.')))
                                                await context.bot.send_message(chat_id=update.effective_chat.id, text="SN ONT "+str(update.message.text.replace('"', ' ').replace("'", '').replace(",", '.'))+" Telah ditambahkan, silahkan masukan SN STB")
                                            else:
                                                if (libteknisi.cekpengisiandata(chat_id, 'snstb_ft') == False):
                                                    libteknisi.to_crud(chat_id, 'snstb_ft', str(
                                                        update.message.text.replace('"', ' ').replace("'", '').replace(",", '.')))
                                                    await context.bot.send_message(chat_id=update.effective_chat.id, text="SN STB "+str(update.message.text.replace('"', ' ').replace("'", '').replace(",", '.'))+" Telah ditambahkan, silahkan masukan ID Valins")
                                                else:
                                                    if (libteknisi.cekpengisiandata(chat_id, 'id_valins_ft') == False):
                                                        libteknisi.to_crud(chat_id, 'id_valins_ft', str(
                                                            update.message.text.replace('"', ' ').replace("'", '').replace(",", '.')))
                                                        await context.bot.send_message(chat_id=update.effective_chat.id, text="ID Valins "+str(update.message.text.replace('"', ' ').replace("'", '').replace(",", '.'))+" Telah ditambahkan, silahkan masukan User Crew")
                                                    else:
                                                        if (libteknisi.cekpengisiandata(chat_id, 'user_crew_ft') == False):
                                                            libteknisi.to_crud(chat_id, 'user_crew_ft', str(
                                                                update.message.text.replace('"', ' ').replace("'", '').replace(",", '.')))
                                                            await context.bot.send_message(chat_id=update.effective_chat.id, text="User Crew "+str(update.message.text.replace('"', ' ').replace("'", '').replace(",", '.'))+" Telah ditambahkan, silahkan masukan user telegram teknisi sektor yang approve penarikan")
                                                        else:
                                                            if (libteknisi.cekpengisiandata(chat_id, 'appsektor_ft') == False):

                                                                libteknisi.to_crud(chat_id, 'appsektor_ft', str(
                                                                    update.message.text.replace('"', ' ').replace("'", '').replace(",", '.')))
                                                                await context.bot.send_message(chat_id=update.effective_chat.id, text="App Sektor "+str(update.message.text.replace('"', ' ').replace("'", '').replace(",", '.'))+" Telah ditambahkan, Silahkan masukan ODP dengan format :  ODP-TSM-FAA/001")
                                                            else:
                                                                if (libteknisi.cekpengisiandata(chat_id, 'odp') == False):
                                                                    regex = r"^(ODP)-(\D{0,3})-(\D{0,3})/(\d+)$"
                                                                    matches = re.search(regex, update.message.text.replace(
                                                                        '"', ' ').replace("'", '').replace(",", '.'))
                                                                    if matches:
                                                                        libteknisi.to_crud(chat_id, 'odp', str(update.message.text.replace(
                                                                            '"', ' ').replace("'", '').replace(",", '.')))
                                                                        await context.bot.send_message(chat_id=update.effective_chat.id, text="ODP "+str(update.message.text.replace('"', ' ').replace("'", '').replace(",", '.'))+" Telah ditambahkan, silahkan masukan Keterangan Anda.")
                                                                    else:
                                                                        await context.bot.send_message(chat_id=update.effective_chat.id, text="Mohon Masukan Nama ODP dengan format: ODP-TSM-FAA/001 ")
                                                                else:
                                                                    if (libteknisi.cekpengisiandata(chat_id, 'keterangan_f_tek') == False):
                                                                        libteknisi.to_crud(chat_id, 'keterangan_f_tek', str(
                                                                            update.message.text.replace('"', ' ').replace("'", '').replace(",", '.')))
                                                                        from datetime import datetime
                                                                        dt = datetime.today()  # Get timezone naive now
                                                                        sekarang = round(
                                                                            dt.timestamp())-25200
                                                                        libteknisi.to_crud(
                                                                            chat_id, 'wkt_ft', str(sekarang))
                                                                        await context.bot.send_message(chat_id=update.effective_chat.id, text=libteknisi.inputSummary(chat_id), reply_markup=InlineKeyboardMarkup(kbKonfirmasi))
                                                                    else:
                                                                        await context.bot.send_message(chat_id=update.effective_chat.id, text="Mohon Respon Tombol Konfirmasi (YA/TIDAK)", reply_markup=ReplyKeyboardMarkup(kbmenu))
            elif (libteknisi.read_aksi_teknisi(chat_id) == 3):
                if (libteknisi.cek_crud(chat_id) == False):
                    if (libteknisi.cekOrderIdTeknisi(chat_id, update.message.text.replace('"', ' ').replace("'", '').replace(",", '.')) == True):
                        libteknisi.add_to_crud(chat_id, update.message.text.replace(
                            '"', ' ').replace("'", '').replace(",", '.'), 4)
                        libteknisi.to_crud(chat_id, 'alamat_inst_tpken_ft', 4)
                        await context.bot.send_message(chat_id=update.effective_chat.id, text="Order-ID "+update.message.text.replace('"', ' ').replace("'", '').replace(",", '.').upper()+" telah dipilih, Silahkan masukan Nomor Hp Pelanggan!!", reply_markup=ReplyKeyboardMarkup([[KeyboardButton("Batal")]], resize_keyboard=True))
                    else:
                        await context.bot.send_message(chat_id=update.effective_chat.id, text="Mohon pilih Order-ID Yang telah tersedia", reply_markup=ReplyKeyboardMarkup(libteknisi.kbOrder_id(chat_id)))
                else:
                    if (libteknisi.cekpengisiandata(chat_id, 'no_plg_ft') == False):
                        if (update.message.text.replace('"', ' ').replace("'", '').replace(",", '.').isnumeric() == True):
                            libteknisi.to_crud(chat_id, 'no_plg_ft', str(
                                update.message.text.replace('"', ' ').replace("'", '').replace(",", '.')))
                            await context.bot.send_message(chat_id=update.effective_chat.id, text="Nomor hape "+str(update.message.text.replace('"', ' ').replace("'", '').replace(",", '.'))+" Telah ditambahkan, silahkan masukan  Tikor Pelanggan.\nAnda bisa menggunakan fitur Shareloc untuk mendapatkan memasukan Koordinat!!", reply_markup=ReplyKeyboardMarkup([[KeyboardButton("Batal")]], resize_keyboard=True))
                        else:
                            await context.bot.send_message(chat_id=update.effective_chat.id, text="Mohon masukan nomor Hape dengan benar")
                    else:
                        if (libteknisi.cekpengisiandata(chat_id, 'tikor_cp_ft') == False):
                            regex = r"-?\d+\.\d+,-?\d+\.\d+"
                            matches = re.search(regex, update.message.text.replace(
                                '"', ' ').replace("'", ''))
                            if matches:
                                libteknisi.to_crud(chat_id, 'tikor_cp_ft', str(
                                    update.message.text.replace('"', ' ').replace("'", '').replace(",", '$$$')))
                                await context.bot.send_message(chat_id, text="Tikor Calon Pelanggan telah ditambahkan, Silahkan Masukan tanggal janji dengan format DD/MM/YYYY.\nContoh 3 maret 2023 jam 14:20:\n03/03/2023 14:20", reply_markup=ReplyKeyboardMarkup([[KeyboardButton("Batal")]], resize_keyboard=True))
                            else:
                                await context.bot.send_message(chat_id=update.effective_chat.id, text="Mohon Masukan Nama Tikor dengan format: Latitude,Longitude\nContoh:-7.324324,108.234324")
                        else:
                            if (libteknisi.cekpengisiandata(chat_id, 'port_ft') == False):
                                regex = r"^(0[1-9]|[12]\d|3[01])\/(0[1-9]|1[0-2])\/\d{4}\s([01]\d|2[0-3]):([0-5]\d)$"
                                matches = re.search(regex, update.message.text.replace(
                                    '"', ' ').replace("'", '').replace(",", '.'))
                                if matches:
                                    libteknisi.to_crud(chat_id, 'port_ft', str(
                                        update.message.text.replace('"', ' ').replace("'", '').replace(",", '.')))
                                    await context.bot.send_message(chat_id=update.effective_chat.id, text="Waktu Janji pada "+str(update.message.text.replace('"', ' ').replace("'", '').replace(",", '.'))+" Telah ditambahkan. Silahkan masukan keterangan anda", reply_markup=ReplyKeyboardMarkup([[KeyboardButton("Batal")]], resize_keyboard=True))
                                else:
                                    await context.bot.send_message(chat_id=update.effective_chat.id, text="Mohon masukan tanggal janji dengan format DD/MM/YYYY.\nContoh 3 maret 2023 jam 14:20:\n03/03/2023 14:20", reply_markup=ReplyKeyboardMarkup([[KeyboardButton("Batal")]], resize_keyboard=True))
                            else:
                                if (libteknisi.cekpengisiandata(chat_id, 'keterangan_f_tek') == False):
                                    libteknisi.to_crud(chat_id, 'keterangan_f_tek', str(
                                        update.message.text.replace('"', ' ').replace("'", '').replace(",", '.')))
                                    from datetime import datetime
                                    dt = datetime.today()  # Get timezone naive now
                                    sekarang = round(dt.timestamp())-25200
                                    libteknisi.to_crud(
                                        chat_id, 'wkt_ft', str(sekarang))
                                    await context.bot.send_message(chat_id=update.effective_chat.id, text=libteknisi.inputSummary(chat_id), reply_markup=InlineKeyboardMarkup(kbKonfirmasi))
                                else:
                                    await context.bot.send_message(chat_id=update.effective_chat.id, text="Mohon Respon Tombol Konfirmasi (YA/TIDAK)", reply_markup=ReplyKeyboardMarkup(kbmenu))

            else:
                await context.bot.send_message(chat_id=update.effective_chat.id, text="Silahkan pilih menu yang tersedia!", reply_markup=ReplyKeyboardMarkup(kbmenu))

    else:
        await context.bot.send_message(chat_id=update.effective_chat.id, text="Anda tidak terdaftar Teknisi. Mohon Hubungi admin untuk melakukan Pendaftaran", reply_markup=ReplyKeyboardRemove())


async def location(update: Update, context: ContextTypes.DEFAULT_TYPE):
    chat_id = update.effective_chat.id
    usernametele = update.effective_user.username
    current_pos = str(update.message.location.latitude) + \
        ","+str(update.message.location.longitude)
    if (libteknisi.statusteknisi(chat_id) == True):
        if (libteknisi.read_aksi_teknisi(chat_id) == 2):
            if (libteknisi.cek_crud(chat_id) == True):
                if (libteknisi.cekpengisiandata(chat_id, 'tikor_cp_ft') == False):
                    libteknisi.to_crud(chat_id, 'tikor_cp_ft', str(
                        update.message.location.latitude)+"$$$"+str(update.message.location.longitude))
                    await context.bot.send_message(chat_id=update.effective_chat.id, text="Tikor Pelanggan "+current_pos+" Telah ditambahkan, silahkan masukan Port", reply_markup=ReplyKeyboardMarkup([[KeyboardButton("Batal")]], resize_keyboard=True))
                else:
                    await context.bot.send_message(chat_id=update.effective_chat.id, text="Lokasi ini berada pada koordinat Latitude : "+str(update.message.location.latitude)+" dan Longitude : "+str(update.message.location.longitude))
            else:
                await context.bot.send_message(chat_id=update.effective_chat.id, text="Lokasi ini berada pada koordinat Latitude : "+str(update.message.location.latitude)+" dan Longitude : "+str(update.message.location.longitude))
        elif (libteknisi.read_aksi_teknisi(chat_id) == 3):
            if (libteknisi.cek_crud(chat_id) == True):
                if (libteknisi.cekpengisiandata(chat_id, 'tikor_cp_ft') == False):
                    libteknisi.to_crud(chat_id, 'tikor_cp_ft', str(
                        update.message.location.latitude)+"$$$"+str(update.message.location.longitude))
                    await context.bot.send_message(chat_id=update.effective_chat.id, text="Tikor Pelanggan "+current_pos+" Telah ditambahkan, Silahkan Masukan tanggal janji dengan format DD/MM/YYYY.\nContoh 3 maret 2023 jam 14:20:\n03/03/2023 14:20", reply_markup=ReplyKeyboardMarkup([[KeyboardButton("Batal")]], resize_keyboard=True))
                else:
                    await context.bot.send_message(chat_id=update.effective_chat.id, text="Lokasi ini berada pada koordinat Latitude : "+str(update.message.location.latitude)+" dan Longitude : "+str(update.message.location.longitude))
            else:
                await context.bot.send_message(chat_id=update.effective_chat.id, text="Lokasi ini berada pada koordinat Latitude : "+str(update.message.location.latitude)+" dan Longitude : "+str(update.message.location.longitude))
        else:
            await context.bot.send_message(chat_id=update.effective_chat.id, text="Lokasi ini berada pada koordinat Latitude : "+str(update.message.location.latitude)+" dan Longitude : "+str(update.message.location.longitude))
    else:
        await context.bot.send_message(chat_id=update.effective_chat.id, text="Anda tidak terdaftar Teknisi. Mohon Hubungi admin untuk melakukan Pendaftaran", reply_markup=ReplyKeyboardRemove())


async def jawaban(update: Update, context: ContextTypes.DEFAULT_TYPE) -> None:
    query = update.callback_query.data
    chat_id = update.effective_chat.id
    if 'pindah' in query:
        await context.bot.answer_callback_query(callback_query_id=update.callback_query.id, text='Feedback Anda telah dikirim kepada Helpdesk', show_alert=True)
        await update.effective_message.edit_reply_markup(None)
        await context.bot.send_message(chat_id=update.effective_chat.id, text="Data berhasil dikirim ke Helpdesk", reply_markup=ReplyKeyboardMarkup(kbmenu))
        libteknisi.pindahData(chat_id)
        libteknisi.destroysesion(chat_id)
    if 'jangan' in query:
        libteknisi.destroysesion(chat_id)
        await context.bot.answer_callback_query(callback_query_id=update.callback_query.id, text='Terimakasih atas perhatian anda', show_alert=True)
        await update.effective_message.edit_reply_markup(None)
        await context.bot.send_message(chat_id=update.effective_chat.id, text="Hasil feedback Anda tidak Disimpan", reply_markup=ReplyKeyboardMarkup(kbmenu))

if __name__ == '__main__':
    print("Bot Started")

    application = ApplicationBuilder().token(BOT_TOKEN).build()
    echo_handler = MessageHandler(filters.TEXT & (~filters.COMMAND), echo)
    location_handler = MessageHandler(filters.LOCATION, location)

    start_handler = CommandHandler('start', start)

    application.add_handler(start_handler)
    application.add_handler(echo_handler)
    application.add_handler(location_handler)
    application.add_handler(CallbackQueryHandler(jawaban))

    application.run_polling()
