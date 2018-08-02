package com.pintar_android.dummyonesignal;

import android.app.Application;

import com.onesignal.OneSignal;

/**
 * Class ini adalah obyek dari Application. Kita bisa menuliskan sesuatu di fungsi
 * onCreate pada class ini, supaya kode tersebut dijalankan ketika aplikasi baru dijalankan
 * pada hape user.
 */
public class ApplicationClass extends Application {

    @Override
    public void onCreate() {
        super.onCreate();

        //kita menginisialisasi onesignal dengan 4 baris berikut ini.
        OneSignal.startInit(this) //mulai proses inisialisasi
                .inFocusDisplaying(OneSignal.OSInFocusDisplayOption.Notification) //menampilkan notifikasi ketika aplikasi sedang dipakai user
                .unsubscribeWhenNotificationsAreDisabled(true) //jika notifikasi dinonaktifkan, maka unsubscribe (hapus langganan) user dari onesignal
                .init();
    }

}
