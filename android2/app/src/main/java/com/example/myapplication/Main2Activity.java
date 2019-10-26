package com.example.myapplication;

import androidx.annotation.RequiresApi;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Build;
import android.os.Bundle;
import android.widget.ImageView;
import android.widget.Toast;
import org.web3j.crypto.ECDSASignature;
import org.web3j.crypto.ECKeyPair;
import org.web3j.crypto.Keys;
import org.web3j.crypto.Sign;

import java.math.BigInteger;

public class Main2Activity extends AppCompatActivity {

    @RequiresApi(api = Build.VERSION_CODES.LOLLIPOP)
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main2);
        Intent intent = getIntent();
        String s = intent.getStringExtra("url");
        String[] mas = s.split(" ");
        ImageView imageView = findViewById(R.id.status);

        String addressRecovered = null;
        boolean match = false;
        String pas = "password";
        String owner = "";

        // Iterate for each possible key to recover
        for (int i = 0; i < 4; i++) {
            BigInteger publicKey =
                    Sign.recoverFromSignature(
                            (byte) i,
                            new ECDSASignature(
                                    new BigInteger(1, mas[1].getBytes()), new BigInteger(1, mas[2].getBytes())),
                            pas.getBytes());

            if (publicKey != null) {
                addressRecovered = "0x" + Keys.getAddress(publicKey);
                //String s = "0x" + Keys.getAddress(credentials.getEcKeyPair().getPublicKey());
                if(owner.equals(addressRecovered)) {
                    match = true;
                    break;
                }
            }
        }

        if(match) {
            imageView.setImageDrawable(getDrawable(R.drawable.ok));
        }

        Toast.makeText(getApplicationContext(), s, Toast.LENGTH_LONG).show();

    }
}
