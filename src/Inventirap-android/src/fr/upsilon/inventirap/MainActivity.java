package fr.upsilon.inventirap;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.content.pm.PackageInfo;
import android.content.pm.PackageManager;
import android.content.pm.PackageManager.NameNotFoundException;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.Toast;

public class MainActivity extends Activity {
	private final int QRCODE_RESULT = 0;
	
	private Context context;
	private Button scanButton;
	private Button ParamsButton;
	
    /** Called when the activity is first created. */
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.main);
        
        context = this;
        
        scanButton = (Button) findViewById(R.id.scanButton);
        scanButton.setOnClickListener(new OnClickListener() {
			
			public void onClick(View v) {
				//check ZXing presence
				try {
					PackageManager pm = getPackageManager();
					pm.getPackageInfo("com.google.zxing.client.android", 0);
				} catch (NameNotFoundException e) {
					Toast t = Toast.makeText(context, R.string.zxing_not_found, Toast.LENGTH_LONG);
					t.show();
					return;
				}

				// start ZXing QR Code decoder
		        Intent intent = new Intent("com.google.zxing.client.android.SCAN");
		        intent.putExtra("SCAN_MODE", "QR_CODE_MODE");
		        startActivityForResult(intent, QRCODE_RESULT);
			}
		});
        
        ParamsButton = (Button) findViewById(R.id.paramsButton);
        ParamsButton.setOnClickListener(new OnClickListener() {
			
			public void onClick(View v) {
				Log.d("", "click on params");
				Intent paramIntent = new Intent(context, ParametersActivity.class);
				startActivity(paramIntent);
			}
		});
        
        
        
    }
    
    /* result from QR Code detection */
    public void onActivityResult(int requestCode, int resultCode, Intent intent) {
    	
        if (requestCode == QRCODE_RESULT) {
            if (resultCode == RESULT_OK) {
                String contents = intent.getStringExtra("SCAN_RESULT");
                String format = intent.getStringExtra("SCAN_RESULT_FORMAT");
                Log.d(this.getClass().getName(), "content : " + contents);
                
                Intent resultIntent = new Intent(context, DisplayResultActivity.class);
                startActivity(resultIntent);
                
                // Handle successful scan
            } else if (resultCode == RESULT_CANCELED) {
                Toast toast = Toast.makeText(context, R.string.qr_code_not_found, Toast.LENGTH_LONG);
                toast.show();
            }
        }
    }
}