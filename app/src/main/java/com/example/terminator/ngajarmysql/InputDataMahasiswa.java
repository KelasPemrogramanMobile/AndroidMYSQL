package com.example.terminator.ngajarmysql;

import android.app.ProgressDialog;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

import volley.AppController;
import volley.Config_URL;

public class InputDataMahasiswa extends AppCompatActivity {

    private ProgressDialog pDialog;
    private static final String TAG = InputDataMahasiswa.class.getSimpleName();

    private EditText edNpm;
    private EditText edNama;
    private EditText edAlamat;

    private Button btnInputData;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_input_data_mahasiswa);

        // Progress dialog
        pDialog = new ProgressDialog(this);
        pDialog.setCancelable(false);

        edNpm    = (EditText) findViewById(R.id.edNpm);
        edNama   = (EditText) findViewById(R.id.edNama);
        edAlamat = (EditText) findViewById(R.id.edAlamat);

        btnInputData = (Button) findViewById(R.id.btnInput);

        btnInputData.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String npmNya       = edNpm.getText().toString();
                String namaNya      = edNama.getText().toString();
                String alamatNya    = edAlamat.getText().toString();

                if(!npmNya.isEmpty() && !namaNya.isEmpty() && !alamatNya.isEmpty()){
                    inputDataMahasiswa(npmNya, namaNya, alamatNya);
                }else{
                    Toast.makeText(getApplicationContext(), "Data Tidak Boleh Kosong",
                            Toast.LENGTH_LONG).show();
                }
            }
        });
    }

    private void inputDataMahasiswa(final String npm,final String nama,final String alamat) {
        // Tag used to cancel the request
        String tag_string_req = "req_input_data";

        pDialog.setMessage("Loading....");
        showDialog();

        StringRequest strReq = new StringRequest(Request.Method.POST,
                Config_URL.base_URL, new Response.Listener<String>() {

            @Override
            public void onResponse(String response) {
                Log.d(TAG, "Register Response: " + response.toString());
                hideDialog();

                try {
                    JSONObject jObj = new JSONObject(response);
                    boolean error = jObj.getBoolean("error");

                    if (!error) {
                        // Launch login activity
                        String errorrr = jObj.getString("success");
                        Toast.makeText(getApplicationContext(),
                                errorrr, Toast.LENGTH_LONG).show();
                    } else {

                        // Error occurred in registration. Get the error
                        // message
                        String errorMsg = jObj.getString("error_msg");
                        Toast.makeText(getApplicationContext(),
                                errorMsg, Toast.LENGTH_LONG).show();

                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        }, new Response.ErrorListener() {

            @Override
            public void onErrorResponse(VolleyError error) {
                Log.e(TAG, "Registration Error: " + error.getMessage());
                Toast.makeText(getApplicationContext(),
                        error.getMessage(), Toast.LENGTH_LONG).show();
                hideDialog();
            }
        }) {

            @Override
            protected Map<String, String> getParams() {
                // Posting params to register url
                Map<String, String> params = new HashMap<String, String>();
                params.put("tag", "inputDataMHS");
                params.put("npm", npm);
                params.put("nama", nama);
                params.put("alamat", alamat);
                return params;
            }

        };

        // Adding request to request queue
        AppController.getInstance().addToRequestQueue(strReq, tag_string_req);
    }

    private void showDialog() {
        if (!pDialog.isShowing())
            pDialog.show();
    }

    private void hideDialog() {
        if (pDialog.isShowing())
            pDialog.dismiss();
    }

    //Fungsi Kembali
    @Override
    public void onBackPressed() {
        Intent a = new Intent(InputDataMahasiswa.this, MainActivity.class);
        startActivity(a);
        finish();
    }
}
