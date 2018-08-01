package com.pintar_android.dummyonesignal;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import com.onesignal.OSPermissionSubscriptionState;
import com.onesignal.OneSignal;

public class HomeActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        TextView textView = findViewById(R.id.textView);
        Button bSignOut = findViewById(R.id.bSignOut);

        CurrentUser currentUser = GlobalFunctions.getCurrentUser(this);

        textView.setText("Selamat datang, "+currentUser.getName()
                +"\n\nOnesignal UserId Anda adalah: "+currentUser.getOneSignalUserId());

        bSignOut.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                GlobalFunctions.removeCurrentUser(HomeActivity.this);
                startActivity(new Intent(getApplicationContext(),LoginActivity.class));
            }
        });
    }



}
