package com.example.terminator.ngajarmysql;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import SessionManager.SessionManager;

public class MainActivity extends AppCompatActivity {

    TextView txtNama, txtEmail;

    Button btnLogOut;
    Button btnLihatdataMahasiswa;
    Button btnInputDataMahasiswa;

    private SessionManager session;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        session = new SessionManager(getApplicationContext());

        txtNama    = (TextView) findViewById(R.id.txtNama);
        txtEmail   = (TextView) findViewById(R.id.txtEmail);

        btnInputDataMahasiswa = (Button) findViewById(R.id.btnInputDataMhs);

        btnInputDataMahasiswa.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent inputData = new Intent(MainActivity.this,
                        InputDataMahasiswa.class);
                startActivity(inputData);
                finish();
            }
        });

        btnLihatdataMahasiswa = (Button) findViewById(R.id.btnLihatDataMhs);
        btnLihatdataMahasiswa.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent inputData = new Intent(MainActivity.this,
                        ViewData.class);
                startActivity(inputData);
                finish();
            }
        });

        SharedPreferences prefs = getSharedPreferences("UserDetails",
                Context.MODE_PRIVATE);

        if(session.isLoggedIn()){
            String id       = prefs.getString("uid","");
            String nama     = prefs.getString("namanya", "");
            String email    = prefs.getString("email", "");

            txtNama.setText(nama);
            txtEmail.setText(email);
        }

        btnLogOut = (Button) findViewById(R.id.btnLogOut);
        btnLogOut.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                session.setLogin(false);
                session.setSessid(0);

                // Launching the login activity
                Intent intent = new Intent(MainActivity.this, LoginActivity.class);
                startActivity(intent);
                finish();
            }
        });
    }
}
