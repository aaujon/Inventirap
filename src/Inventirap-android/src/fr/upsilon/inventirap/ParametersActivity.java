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
	private EditText loginEditText;
	private EditText passEditText;
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
        String server_ip = prefs.getString("SERVERIP", "");
        serverEditText.setText(server_ip);
        
        loginEditText = (EditText) findViewById(R.id.loginEditText);
        String login = prefs.getString("LOGIN", "");
        loginEditText.setText(login);
        
        passEditText = (EditText) findViewById(R.id.passEditText);
        String pass = prefs.getString("PASSWORD", "");
        passEditText.setText(pass);
    }
    
    @Override
    public boolean onKeyDown(int keyCode, KeyEvent event) {
        if ((keyCode == KeyEvent.KEYCODE_BACK)) {
        	//String keyString = "mykeyislongenoug";

        	// get server ip
        	String server_ip = serverEditText.getText().toString();
        	
        	// check http(s)://
        	if (!server_ip.startsWith("http://") && !server_ip.startsWith("https://"))
        		server_ip = "http://"+server_ip;
        	
        	String login = loginEditText.getText().toString();
        	String pass = passEditText.getText().toString();
        	//String encodedPass = null;

        	/*try {
        		byte[] mykey = keyString.getBytes();
        		
        		Log.d("", "key length : " + mykey.length);
        		SecretKey key = new SecretKeySpec(mykey, "AES");
				Cipher c = Cipher.getInstance("AES/ECB/ZeroBytePadding");
				c.init(Cipher.ENCRYPT_MODE, key);
				
				// Encode the string into bytes using utf-8
				pass = new String("s:"+pass.length()+":").concat(pass).concat(";");
	            byte[] utf8 = pass.getBytes("UTF8");//getBytes("UTF8");

	            // Encrypt
	            byte[] enc = c.doFinal(utf8);

	            // Encode bytes to base64 to get a string
	            encodedPass =  Base64.encodeToString(enc, Base64.DEFAULT);
			} catch (Exception e) {
				Log.d("", e.getMessage());
				Toast.makeText(context, "Erreur de cryptage", Toast.LENGTH_SHORT).show();
				finish();
			}*/
 
        	// save in preferences
            Log.d(this.getClass().getName(), "back button pressed, save prefs.");
            Log.d(this.getClass().getName(), "server ip : "+server_ip);
            Log.d(this.getClass().getName(), "login : "+login);
            Log.d(this.getClass().getName(), "pass : "+pass);
            //Log.d(this.getClass().getName(), "encoded pass : "+encodedPass);


            
            Editor editor = prefs.edit();
            
            editor.putString("SERVERIP", server_ip);
            editor.putString("LOGIN", login);
            editor.putString("PASSWORD", pass);
           // editor.putString("ENCODEDPASS", encodedPass);
            editor.commit();
            
            finish();
            
        }
        return super.onKeyDown(keyCode, event);
    }

    
    
}