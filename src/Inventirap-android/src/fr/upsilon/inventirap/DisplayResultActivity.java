package fr.upsilon.inventirap;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Iterator;
import java.util.List;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.ListActivity;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.ListAdapter;
import android.widget.SimpleAdapter;
import android.widget.SimpleExpandableListAdapter;

public class DisplayResultActivity extends ListActivity {
	
	private Context context;
	private ListAdapter adapter;
    ArrayList<HashMap<String, String>> childList= new ArrayList<HashMap<String,String>>();

	
    /** Called when the activity is first created. */
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.display_result);
        
        context = this;
        
        Button buttonPlus = (Button)findViewById(R.id.buttonPlus);
        buttonPlus.setOnClickListener(new OnClickListener() {
			
			public void onClick(View v) {
				// start expandable view
				Intent intent = new Intent(context, DisplayExtendedResultActivity.class);
                startActivity(intent);
				
			}
		});
        
        JSONObject json = WebServicesTools.jsonObj;
        try {
        	JSONArray jsonArray = json.getJSONArray("materials");
        	json = jsonArray.getJSONObject(0);
        	//String j = json.getString("materials");
        	//Log.d("", (String)json.keys().next());
        	//Log.d("", j);
			//json = new JSONObject(j);
		} catch (JSONException e1) {
			finish();
		}
        int length = json.length();

        Log.d("", "json length : "+length);
        
        Iterator it = json.keys();
        while (it.hasNext()) {
        	String name = (String) it.next();
        	
        	HashMap<String, String> map = new HashMap<String, String>();
        	String value = "";
        	String text = "";
        	
        	// get value
			try {		
				value = json.getString(name);
				Log.d("", "get :" + name);
				
				if (name.compareTo("Category") == 0) {
					value = json.getJSONObject("Category").getString("nom");
				/*} else if (name.compareTo("SousCategory") == 0) {
					value = json.getJSONObject("SousCategory").getString("nom");
				} else if (name.compareTo("WorkGroup") == 0) {
					value = json.getJSONObject("WorkGroup").getString("nom");
				} else if (name.compareTo("ThematicGroup") == 0) {
					value = json.getJSONObject("ThematicGroup").getString("nom");*/
				} else if (name.compareTo("Materiel") == 0) {
					JSONObject material = json.getJSONObject("Materiel");
					
		        	HashMap<String, String> map2 = new HashMap<String, String>();
					map2.put("1", "Numéro IRAP");
					map2.put("2", material.getString("numero_irap"));
					childList.add(map2);
					
					HashMap<String, String> map3 = new HashMap<String, String>();
					map3.put("1", "Désignation");
					map3.put("2", material.getString("designation"));
					childList.add(map3);
					
					HashMap<String, String> map4 = new HashMap<String, String>();
					map4.put("1", "Organisme");
					map4.put("2", material.getString("organisme"));
					childList.add(map4);
					
					HashMap<String, String> map5 = new HashMap<String, String>();
					map5.put("1", "Nom du responsable");
					map5.put("2", material.getString("nom_responsable"));
					childList.add(map5);
					
					HashMap<String, String> map6 = new HashMap<String, String>();
					map6.put("1", "Lieu");
					map6.put("2", material.getString("full_storage"));
					childList.add(map6);
					
				}
				
			} catch (JSONException e) {
			}

			/*if (name.compareTo("Materiel") == 0) {
				
			} else {
	        	map.put("1", "");
	        	map.put("2", value);
	        		        	
	        	childList.add(map);
			}*/
        }
        
       /* adapter = new SimpleExpandableListAdapter(context, myList, R.layout.element,
        		new String[] {"1", "2"},
        		new int[] {R.id.field1, R.id.field2});
        */		
        adapter = new SimpleAdapter(context, 
        		childList, R.layout.element, new String[] {"1", "2"}, new int[] {R.id.field1, R.id.field2});
        setListAdapter(adapter);
        
    }
    
    
}