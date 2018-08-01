package com.pintar_android.dummyonesignal;

import android.app.Application;

import com.onesignal.OneSignal;

/**
 * Created by Meidika on 31/07/2018.
 */
public class ApplicationClass extends Application {

    @Override
    public void onCreate() {
        super.onCreate();

//        OneSignal.setLogLevel(OneSignal.LOG_LEVEL.DEBUG, OneSignal.LOG_LEVEL.DEBUG);

        // OneSignal Initialization
        OneSignal.startInit(this)
                .inFocusDisplaying(OneSignal.OSInFocusDisplayOption.Notification)
                .unsubscribeWhenNotificationsAreDisabled(true)
                .init();
    }

}
