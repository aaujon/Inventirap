package fr.upsilon.inventirap;

import android.app.Activity;
import android.content.Context;
import android.content.SharedPreferences;
import android.content.SharedPreferences.Editor;
import android.os.Bundle;
import android.util.Log;
import android.view.KeyEvent;
import android.widget.EditText;

public class ParametersActivity extends Activity {
	
	private Context context;
	private EditText serverEditText;
	private SharedPreferences prefs;
	
    /** Called when the activity is first created. */
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.parameters);
        
        context = this;
        
        String name = getResources().getString(R.string.app_name);
        prefs = context.getSharedPreferences(name, MODE_PRIVATE);
        
        serverEditText = (EditText) findViewById(R.id.serverEditText);
        String server_ip = prefs.getString(getResources().getString(R.string.SERVER_IP), "");
        serverEditText.setText(server_ip);
    }
    
    @Override
    public boolean onKeyDown(int keyCode, KeyEvent event) {
        if ((keyCode == KeyEvent.KEYCODE_BACK)) {
        	// get server ip
        	String server_ip = serverEditText.getText().toString();
        	
        	// check http://
        	if (!server_ip.startsWith("http://"))
        		server_ip = "http://"+server_ip;
        	
        	// save server addr in preferences
            Log.d(this.getClass().getName(), "back button pressed, save prefs.");
            Log.d(this.getClass().getName(), "server ip : "+server_ip);
            
            Editor editor = prefs.edit();
            
            editor.putString(getResources().getString(R.string.SERVER_IP), server_ip);
            editor.commit();
            
            finish();
            
        }
        return super.onKeyDown(keyCode, event);
    }

    
    
}