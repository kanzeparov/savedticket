package come.manager.direct.hackuniversity;

import android.graphics.Bitmap;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.ImageView;

import net.glxn.qrgen.android.QRCode;

import org.web3j.crypto.Credentials;
import org.web3j.crypto.Sign;

import java.io.UnsupportedEncodingException;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;

public class ImageActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_image);
        ImageView imageView = findViewById(R.id.info_image);

        Credentials credentials = Credentials.create("9c215ede75b688ce2f30372140068c815b78b2eedfe8bd9af04d8d7fddd8ef2e");


        // send the signed transaction to the ethereum client




        MessageDigest digest = null;
        byte[] output = null;
        String pas = "password";
        try {
            digest = MessageDigest.getInstance("SHA512");
            output = digest.digest( pas.getBytes("UTF-8"));
        } catch (NoSuchAlgorithmException e) {
            e.printStackTrace();
        } catch (UnsupportedEncodingException e) {
            e.printStackTrace();
        }

        Sign.SignatureData signature = Sign.signMessage(pas.getBytes(), credentials.getEcKeyPair());


        if(getIntent().getBooleanExtra("status",false)) {
            Bitmap myBitmap = QRCode.from("123 " + signature.getR().toString() + " " + signature.getS().toString()).bitmap();
            imageView.setImageBitmap(myBitmap);
            //mageView.setImageResource(R.drawable.with);
        }
    }
}
