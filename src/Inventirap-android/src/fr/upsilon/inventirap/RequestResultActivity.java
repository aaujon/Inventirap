package fr.upsilon.inventirap;

import org.apache.http.HttpResponse;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.Toast;

public class RequestResultActivity extends Activity {
	private final int QRCODE_RESULT = 0;
	
	private Context context;
	private Button scanButton;
	private Button ParamsButton;
	
	private Runnable runnable;
	
    /** Called when the activity is first created. */
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.request_result);
        
        context = this;
        String server_ip_internal = getResources().getString(R.string.SERVER_IP);
        final String server_ip = getIntent().getExtras().getString(server_ip_internal);
        
        runnable = new Runnable(){
            public void run() {
                String result = WebServicesTools.getXML(context, server_ip);
                WebServicesTools.XMLFromString(result);
                
                Log.d(context.getClass().getName(), "XML received and decoded !!");
            }
        };
        Thread thread =  new Thread(null, runnable, "InventirapServerRequest");
        thread.start();

        
       
        
        
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