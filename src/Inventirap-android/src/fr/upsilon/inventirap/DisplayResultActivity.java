package fr.upsilon.inventirap;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.widget.Toast;

public class DisplayResultActivity extends Activity {
	private final int QRCODE_RESULT = 0;
	
	private Context context;
	
    /** Called when the activity is first created. */
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.display_result);
        
        context = this;
        
        // start ZXing CR Code decoder
        Intent intent = new Intent("com.google.zxing.client.android.SCAN");
        intent.putExtra("SCAN_MODE", "QR_CODE_MODE");
        startActivityForResult(intent, QRCODE_RESULT);
    }
    
    
}