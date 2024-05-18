

import sflib
import sflibrary
from telegram import Update
from telegram.ext import filters, MessageHandler, ApplicationBuilder, CommandHandler, ContextTypes, CallbackContext, CallbackQueryHandler
from asyncio.windows_events import NULL
from dotenv import load_dotenv
import os
import re
from telegram import KeyboardButton, ReplyKeyboardMarkup, ReplyKeyboardRemove, __version__ as TG_VER
from telegram import InlineKeyboardButton, InlineKeyboardMarkup, Update
from datetime import datetime
from datetime import datetime

BOT_TOKEN = os.getenv("TOKEN_BOT_SALES_DEV")
now = datetime.now()
sekarang = now.strftime("%d-%m-%Y %H:%M:%S")
print('Bot Started at : ' + sekarang)

kbmenu = [[KeyboardButton("tambahwo")], [KeyboardButton("listwo")], [
    KeyboardButton("checkwo")]]
kbkonfirmasi = [[InlineKeyboardButton('Ya', callback_data='pindahkan')], [
    InlineKeyboardButton('Tidak', callback_data='destroy')]]


async def start(update: Update, context: ContextTypes.DEFAULT_TYPE) -> None:
    chat_id = update.effective_chat.id
    usernametele = update.effective_user.username
    if (sflibrary.read_user_status(update.effective_chat.id) == "1"):
        sflibrary.isiLogData(sekarang, chat_id, usernametele,
                             'Starting Bot', "/start", 'Telegram terdaftar')
        await context.bot.send_message(chat_id=update.effective_chat.id, text="ID Telegram anda telah terdaftar, Silahkan pilih menu yang tersedia!", reply_markup=ReplyKeyboardMarkup(kbmenu))
    else:
        sflibrary.isiLogData(sekarang, chat_id, usernametele,
                             'Starting Bot', "/start", 'Telegram Tidak terdaftar')
        await context.bot.send_message(chat_id=update.effective_chat.id, text="Anda tidak terdaftar sebagai Sales Force, mohon hubungi admin.", reply_markup=ReplyKeyboardRemove())


async def location(update: Update, context: ContextTypes.DEFAULT_TYPE):

    chat_id = update.effective_chat.id
    current_pos = str(update.message.location.latitude) + \
        ","+str(update.message.location.longitude)
    usernametele = update.effective_user.username
    if (sflibrary.cek_aksi(chat_id) == 3):
        if (sflibrary.cekpengisiandata(chat_id, 'tikor_odp') == True):
            sflibrary.isidata(chat_id, str(update.message.location.latitude) +
                              "$$$"+str(update.message.location.longitude), 'tikor_odp')
            await context.bot.send_message(chat_id, text="Titik ODP "+current_pos+" Telah ditambahkan.\nsilahkan masukan Titik Calon Pelanggan, Anda bisa menggunakan fitur ShareLoc untuk memberikan Koordinat atau jika anda input manual ikuti format (Latitude Longitude) seperti : -7.12345 108.0000")
        else:
            if (sflibrary.cekpengisiandata(chat_id, 'tikor_cp') == True):
                sflibrary.isidata(chat_id, str(update.message.location.latitude) +
                                  "$$$"+str(update.message.location.longitude), 'tikor_cp')
                await context.bot.send_message(chat_id, text="Titik Calon Pelanggan "+current_pos+" Telah ditambahkan.\nsilahkan masukan Datek ODP dengan format : ODP-TSM-FAA/001")
    else:
        await context.bot.send_message(chat_id, text="Lokasi ini berada pada koordinat Latitude : "+str(update.message.location.latitude)+" dan Longitude : "+str(update.message.location.longitude))


async def echo(update: Update, context: ContextTypes.DEFAULT_TYPE) -> None:

    now = datetime.now()
    sekarang = now.strftime("%d-%m-%Y %H:%M:%S")

    chat_id = str(update.effective_user.id)
    usernametele = update.effective_user.username
    # nama_lengkap = update.effective_user.first_name+" "+update.effective_user.last_name

    if (sflibrary.read_user_status(update.effective_chat.id) == "1"):
        if (update.message.text.lower() == "tambahwo"):
            sflibrary.atur_aksi(3, chat_id)
            sflibrary.destroysesion(chat_id)
            sflibrary.tambahwo(chat_id, usernametele)
            await context.bot.send_message(chat_id, text="silakan pilih STO yang dipakai", reply_markup=ReplyKeyboardMarkup(sflibrary.liststo()))
        elif (update.message.text.lower() == "batal"):
            sflibrary.atur_aksi(0, chat_id)
            sflibrary.destroysesion(chat_id)
            await context.bot.send_message(chat_id, text="Anda telah membatalkan penambahan data.\nTerimakasih🙏🙏🙏🙏", reply_markup=ReplyKeyboardMarkup(kbmenu))
        elif (update.message.text.lower() == "listwo"):
            sflibrary.atur_aksi(0, chat_id)
            sflibrary.destroysesion(chat_id)
            await context.bot.send_message(chat_id=update.effective_chat.id, text=sflibrary.alldatainput(chat_id), reply_markup=ReplyKeyboardMarkup(kbmenu))
        elif (update.message.text.lower() == "checkwo"):
            sflibrary.atur_aksi(2, chat_id)
            sflibrary.destroysesion(chat_id)
            await context.bot.send_message(chat_id, text="Baik.\nSilahkan informasikan Order-ID yang kamu cari", reply_markup=ReplyKeyboardRemove())
        else:
            if (sflibrary.cek_aksi(chat_id) == 0):
                await context.bot.send_message(chat_id, text="Silahkan pilih menu yang tersedia!", reply_markup=ReplyKeyboardMarkup(kbmenu))
            if (sflibrary.cek_aksi(chat_id) == 1):
                await context.bot.send_message(chat_id, text="Silahkan pilih menu yang tersedia!", reply_markup=ReplyKeyboardMarkup(kbmenu))
            if (sflibrary.cek_aksi(chat_id) == 2):
                await context.bot.send_message(chat_id, text=sflibrary.detilWO(str(update.message.text), usernametele), reply_markup=ReplyKeyboardMarkup(kbmenu))
                sflibrary.atur_aksi(0, chat_id)
            if (sflibrary.cek_aksi(chat_id) == 3):
                if (sflibrary.cekpengisiandata(chat_id, 'sto') == True):
                    if (sflibrary.cekidsto(str(update.message.text)) == ""):
                        sflibrary.isiLogData(sekarang, chat_id, usernametele, 'Tambah WO', str(
                            update.message.text), 'User Mengisi STO yang tidak sesuai')
                        await context.bot.send_message(chat_id, text="Pilih STO yang telah disediakan", reply_markup=ReplyKeyboardMarkup(sflibrary.liststo()))
                    else:
                        sflibrary.isidata(chat_id, sflibrary.cekidsto(
                            str(update.message.text)), 'sto')
                        sflibrary.isidata(chat_id, sflibrary.generate_order_id(
                            str(update.message.text)), 'order_id')
                        await context.bot.send_message(chat_id, text="STO telah ditambahkan, Silahkan masukan Track-ID", reply_markup=ReplyKeyboardMarkup([[KeyboardButton("Batal")]], resize_keyboard=True))
                else:
                    if (sflibrary.cekpengisiandata(chat_id, 'track_id') == True):
                        sflibrary.isidata(chat_id, str(
                            update.message.text), 'track_id')
                        await context.bot.send_message(chat_id, text="Track-ID telah ditambahkan, Silahkan Pilih Layanan!!", reply_markup=ReplyKeyboardMarkup(sflibrary.kb_layanan()))
                    else:
                        if (sflibrary.cekpengisiandata(chat_id, 'layanan') == True):
                            if (sflibrary.cekidLayanan(str(update.message.text)) == ""):
                                sflibrary.isiLogData(sekarang, chat_id, usernametele, 'Tambah WO', str(
                                    update.message.text), 'User Mengisi layanan yang tidak sesuai')
                                await context.bot.send_message(chat_id, text="Silahkan Pilih layanan yang telah disediakan!!", reply_markup=ReplyKeyboardMarkup(sflibrary.kb_layanan()))
                            else:
                                sflibrary.isidata(chat_id, sflibrary.cekidLayanan(
                                    str(update.message.text)), 'layanan')
                                await context.bot.send_message(chat_id, text="Layanan telah ditambahkan, Silahkan Pilih kecepatan!!", reply_markup=ReplyKeyboardMarkup(sflibrary.kb_kecepatan()))
                        else:
                            if (sflibrary.cekpengisiandata(chat_id, 'kecepatan') == True):
                                if (sflibrary.cekidKecepatan(str(update.message.text)) == ""):
                                    sflibrary.isiLogData(sekarang, chat_id, usernametele, 'Tambah WO', str(
                                        update.message.text), 'User Mengisi kecepatan yang tidak sesuai')
                                    await context.bot.send_message(chat_id, text="Silahkan pilih kecepatan yang telah disediakan", reply_markup=ReplyKeyboardMarkup(sflibrary.kb_kecepatan()))
                                else:
                                    sflibrary.isidata(chat_id, sflibrary.cekidKecepatan(
                                        str(update.message.text)), 'kecepatan')
                                    await context.bot.send_message(chat_id, text="kecepatan telah ditambahkan, Silahkan Masukan Nama Calon Pelanggan!!", reply_markup=ReplyKeyboardMarkup([[KeyboardButton("Batal")]], resize_keyboard=True))
                            else:
                                if (sflibrary.cekpengisiandata(chat_id, 'ncp') == True):
                                    sflibrary.isidata(chat_id, str(update.message.text).replace(
                                        ',', " ").replace('\'', ' ').replace('"', " "), 'ncp')
                                    await context.bot.send_message(chat_id, text="Nama Calon Pelanggan telah ditambahkan, Silahkan Masukan Kontak Calon Pelanggan!!", reply_markup=ReplyKeyboardMarkup([[KeyboardButton("Batal")]], resize_keyboard=True))
                                else:
                                    if (sflibrary.cekpengisiandata(chat_id, 'kcp') == True):
                                        if (update.message.text.isnumeric() == True):
                                            if (sflibrary.cekhp(str(update.message.text)) == 0):
                                                sflibrary.isidata(chat_id, str(update.message.text).replace(
                                                    ',', " ").replace('\'', ' ').replace('"', " "), 'kcp')
                                                await context.bot.send_message(chat_id, text="Kontak Calon Pelanggan telah ditambahkan, Silahkan Masukan Kontak Alternatif Calon Pelanggan!!", reply_markup=ReplyKeyboardMarkup([[KeyboardButton("Batal")]], resize_keyboard=True))
                                            else:
                                                await context.bot.send_message(chat_id, text="Nomor ini telah terdaftar, mohon masukan nomor lain", reply_markup=ReplyKeyboardMarkup([[KeyboardButton("Batal")]], resize_keyboard=True))
                                                sflibrary.isiLogData(sekarang, chat_id, usernametele, 'Tambah WO', str(
                                                    update.message.text), 'User Mengisi nomor yang telah terdaftar')
                                        else:
                                            await context.bot.send_message(chat_id, text="Silahkan masukan nomor yang sesuai!!", reply_markup=ReplyKeyboardMarkup([[KeyboardButton("Batal")]], resize_keyboard=True))
                                            sflibrary.isiLogData(sekarang, chat_id, usernametele, 'Tambah WO', str(
                                                update.message.text), 'User Mengisi nomor yang tidak sesuai')
                                    else:
                                        if (sflibrary.cekpengisiandata(chat_id, 'kacp') == True):
                                            if (update.message.text.isnumeric() == True):
                                                if (sflibrary.cekhp(str(update.message.text)) == 0):
                                                    sflibrary.isidata(chat_id, str(update.message.text).replace(
                                                        ',', " ").replace('\'', ' ').replace('"', " "), 'kacp')
                                                    await context.bot.send_message(chat_id, text="Kontak Alternatif Calon Pelanggan telah ditambahkan, Silahkan Masukan ALamat Lengkap Calon Pelanggan!!", reply_markup=ReplyKeyboardMarkup([[KeyboardButton("Batal")]], resize_keyboard=True))
                                                else:
                                                    await context.bot.send_message(chat_id, text="Nomor ini telah terdaftar, mohon masukan nomor lain", reply_markup=ReplyKeyboardMarkup([[KeyboardButton("Batal")]], resize_keyboard=True))
                                                    sflibrary.isiLogData(sekarang, chat_id, usernametele, 'Tambah WO', str(
                                                        update.message.text), 'User Mengisi nomor yang telah terdaftar')
                                            else:
                                                sflibrary.isiLogData(sekarang, chat_id, usernametele, 'Tambah WO', str(
                                                    update.message.text), 'User Mengisi nomor tidak dengan angka')
                                                await context.bot.send_message(chat_id, text="Silahkan masukan nomor yang sesuai!!", reply_markup=ReplyKeyboardMarkup([[KeyboardButton("Batal")]], resize_keyboard=True))
                                        else:
                                            if (sflibrary.cekpengisiandata(chat_id, 'alamat') == True):
                                                sflibrary.isidata(chat_id, str(update.message.text).replace(
                                                    ',', " ").replace('\'', ' ').replace('"', " "), 'alamat')
                                                await context.bot.send_message(chat_id, text="ALamat Lengkap Calon Pelanggan telah ditambahkan, Silahkan Masukan Patokan Alamat!!", reply_markup=ReplyKeyboardMarkup([[KeyboardButton("Batal")]], resize_keyboard=True))
                                            else:
                                                if (sflibrary.cekpengisiandata(chat_id, 'pat_alamat') == True):
                                                    sflibrary.isidata(chat_id, str(update.message.text).replace(
                                                        ',', " ").replace('\'', ' ').replace('"', " "), 'pat_alamat')
                                                    await context.bot.send_message(chat_id, text="Patokan Alamat telah ditambahkan, Silahkan Masukan Desa Calon Pelanggan!!", reply_markup=ReplyKeyboardMarkup([[KeyboardButton("Batal")]], resize_keyboard=True))
                                                else:
                                                    if (sflibrary.cekpengisiandata(chat_id, 'desa') == True):
                                                        sflibrary.isidata(chat_id, str(update.message.text).replace(
                                                            ',', " ").replace('\'', ' ').replace('"', " "), 'desa')
                                                        await context.bot.send_message(chat_id, text="Desa Calon Pelanggan telah ditambahkan, Silahkan Masukan Kecamatan!!", reply_markup=ReplyKeyboardMarkup([[KeyboardButton("Batal")]], resize_keyboard=True))
                                                    else:
                                                        if (sflibrary.cekpengisiandata(chat_id, 'kecamatan') == True):
                                                            sflibrary.isidata(chat_id, str(update.message.text).replace(
                                                                ',', " ").replace('\'', ' ').replace('"', " "), 'kecamatan')
                                                            await context.bot.send_message(chat_id, text="Kecamatan Calon Pelanggan telah ditambahkan, Silahkan Masukan Tikor ODP!!", reply_markup=ReplyKeyboardMarkup([[KeyboardButton("Batal")]], resize_keyboard=True))
                                                        else:
                                                            if (sflibrary.cekpengisiandata(chat_id, 'tikor_odp') == True):
                                                                regex = r"-?\d+\.\d+,-?\d+\.\d+"
                                                                matches = re.search(regex, update.message.text.replace(
                                                                    '"', ' ').replace("'", ''))
                                                                if matches:
                                                                    sflibrary.isidata(chat_id, str(update.message.text).replace(
                                                                        ',', "$$$").replace('\'', ' ').replace('"', " "), 'tikor_odp')
                                                                    await context.bot.send_message(chat_id, text="Tikor ODP telah ditambahkan, Silahkan Masukan Tikor Calon Pelanggan!!", reply_markup=ReplyKeyboardMarkup([[KeyboardButton("Batal")]], resize_keyboard=True))
                                                                else:
                                                                    await context.bot.send_message(chat_id=update.effective_chat.id, text="Mohon Masukan Tikor dengan format:  Latitude,Longitude\nContoh: 7.32748,108.221508")
                                                            else:
                                                                if (sflibrary.cekpengisiandata(chat_id, 'tikor_cp') == True):

                                                                    regex = r"-?\d+\.\d+,-?\d+\.\d+"
                                                                    matches = re.search(regex, update.message.text.replace(
                                                                        '"', ' ').replace("'", ''))
                                                                    if matches:
                                                                        sflibrary.isidata(chat_id, str(update.message.text).replace(
                                                                            ',', "$$$").replace('\'', ' ').replace('"', " "), 'tikor_cp')
                                                                        await context.bot.send_message(chat_id, text="Tikor Calon Pelanggan telah ditambahkan, Silahkan Masukan Datek ODP!!", reply_markup=ReplyKeyboardMarkup([[KeyboardButton("Batal")]], resize_keyboard=True))
                                                                    else:
                                                                        await context.bot.send_message(chat_id=update.effective_chat.id, text="Mohon Masukan Tikor dengan format:  Latitude,Longitude\nContoh: 7.32748,108.221508")

                                                                else:
                                                                    if (sflibrary.cekpengisiandata(chat_id, 'datel_odp') == True):
                                                                        sflibrary.isidata(chat_id, str(update.message.text).replace(
                                                                            ',', " ").replace('\'', ' ').replace('"', " "), 'datel_odp')
                                                                        await context.bot.send_message(chat_id, text="Datek ODP telah ditambahkan, Silahkan Masukan Estimasi Panjang DC!!", reply_markup=ReplyKeyboardMarkup([[KeyboardButton("Batal")]], resize_keyboard=True))
                                                                    else:
                                                                        if (sflibrary.cekpengisiandata(chat_id, 'est_pj_dc') == True):
                                                                            if (update.message.text.isnumeric() == True):
                                                                                sflibrary.isidata(chat_id, str(update.message.text).replace(
                                                                                    ',', " ").replace('\'', ' ').replace('"', " "), 'est_pj_dc')
                                                                                await context.bot.send_message(chat_id, text="Estimasi Panjang DC "+str(update.message.text)+" Meter Telah ditambahkan.\nsilahkan masukan Keterangan/Catatan Anda", reply_markup=ReplyKeyboardMarkup([[KeyboardButton("Batal")]], resize_keyboard=True))
                                                                            else:
                                                                                await context.bot.send_message(chat_id, text="Mohon masukan Angka saja", reply_markup=ReplyKeyboardMarkup([[KeyboardButton("Batal")]], resize_keyboard=True))
                                                                                sflibrary.isiLogData(sekarang, chat_id, usernametele, 'Tambah WO', str(
                                                                                    update.message.text), 'User Mengisi Estimasi Panjang DC tidak dengan angka')
                                                                        else:
                                                                            if (sflibrary.cekpengisiandata(chat_id, 'ket_sales') == True):
                                                                                sflibrary.isidata(chat_id, str(update.message.text).replace(
                                                                                    ',', " ").replace('\'', ' ').replace('"', " "), 'ket_sales')
                                                                                await context.bot.send_message(chat_id, text=sflibrary.hasilinput(str(chat_id)), reply_markup=ReplyKeyboardRemove())
                                                                                await context.bot.send_message(chat_id, text="Apakah anda ingin mengirimkan data ini kepada Inputer/SPP ?\n*Jika anda memilih 'Ya',Maka data akan dikirimkan.\nJika 'Tidak', Maka data ini akan dihapus", reply_markup=InlineKeyboardMarkup(kbkonfirmasi))
                                                                            else:
                                                                                await context.bot.send_message(chat_id, text="Silahkan Pilih Tombol Respon!!", reply_markup=ReplyKeyboardRemove())
                                                                                sflibrary.isiLogData(sekarang, chat_id, usernametele, 'Tambah WO', str(
                                                                                    update.message.text), 'User tidak merespon tombol Konfirmasi')

    else:
        await context.bot.send_message(chat_id, text="Anda belum terdaftar sebagai Sales Force, mohon hubungi admin.", reply_markup=ReplyKeyboardRemove())


async def jawaban(update: Update, context: ContextTypes.DEFAULT_TYPE) -> None:

    query = update.callback_query.data
    # update.callback_query.answer()
    chat_id = update.effective_chat.id

    from datetime import datetime
    dt = datetime.today()  # Get timezone naive now
    sekarang = round(dt.timestamp())-25200
    usernametele = update.effective_user.username
    if 'pindahkan' in query:
        if (sflibrary.cekUserInput(str(chat_id)) != ""):
            if ((sflibrary.cekpengisiandata(chat_id, 'ket_sales')) == False):
                sflibrary.pindahdata(chat_id, sekarang)
                await update.effective_message.edit_reply_markup(None)
                await update.effective_message.edit_text('''Data telah dikirim''')
                await context.bot.answer_callback_query(callback_query_id=update.callback_query.id, text='Terimakasih atas perhatian anda', show_alert=True)
                sflibrary.atur_aksi(0, chat_id)
                await context.bot.send_message(chat_id, text="Silahkan pilih menu yang telah disediakan", reply_markup=ReplyKeyboardMarkup(kbmenu))
            else:
                await update.effective_message.edit_reply_markup(None)
                await update.effective_message.edit_text('''Data gagal dikirim''')
                await context.bot.answer_callback_query(callback_query_id=update.callback_query.id, text='Data tidak lengkap, Mohon melakukan pengisian data ulang', show_alert=True)
        else:
            sflibrary.isiLogData(sekarang, chat_id, usernametele,
                                 "Button Kirim Data", 'Data hasil input tidak ditemukan', 'NOK')
            await context.bot.answer_callback_query(callback_query_id=update.callback_query.id, text='Telah kehilangan sesi. Mohon masukan ulang data ', show_alert=True)

    if 'destroy' in query:
        if (sflibrary.cekUserInput(str(chat_id)) != ""):
            if ((sflibrary.cekpengisiandata(chat_id, 'ket_sales')) == False):
                sflibrary.isiLogData(
                    sekarang, chat_id, usernametele, "Button Batal", 'Data tidak dikirim', 'OK')
                sflibrary.destroysesion(chat_id)
                await update.effective_message.edit_reply_markup(None)
                await update.effective_message.edit_text('''Data telah dibuang''')
                await context.bot.answer_callback_query(callback_query_id=update.callback_query.id, text='Data telah dibuang, silahkan lakukan pengisian data ulang', show_alert=True)
                sflibrary.atur_aksi(0, chat_id)
                await context.bot.send_message(chat_id, text="Silahkan pilih menu yang telah disediakan", reply_markup=ReplyKeyboardMarkup(kbmenu))
            else:
                sflibrary.isiLogData(
                    sekarang, chat_id, usernametele, "Button Batal", 'Data tidak lengkap', 'NOK')
                await context.bot.answer_callback_query(callback_query_id=update.callback_query.id, text='Data tidak lengkap, Mohon melakukan pengisian data ulang', show_alert=True)
        else:
            sflibrary.isiLogData(sekarang, chat_id, usernametele,
                                 "Button Batal", 'Data hasil input tidak ditemukan', 'NOK')
            await context.bot.answer_callback_query(callback_query_id=update.callback_query.id, text='Telah kehilangan sesi. Mohon masukan ulang data'+str(sflib.cekpengisiandata('isi', chat_id, 'ket_sales'))+str(sflib.cekpengisiandata(chat_id, chat_id, 'id_tele')), show_alert=True)


if __name__ == '__main__':

    application = ApplicationBuilder().token(BOT_TOKEN).build()
    echo_handler = MessageHandler(filters.TEXT & (~filters.COMMAND), echo)
    location_handler = MessageHandler(filters.LOCATION, location)
    start_handler = CommandHandler('start', start)

    application.add_handler(start_handler)
    application.add_handler(echo_handler)
    application.add_handler(location_handler)
    application.add_handler(CallbackQueryHandler(jawaban))
    application.run_polling()
