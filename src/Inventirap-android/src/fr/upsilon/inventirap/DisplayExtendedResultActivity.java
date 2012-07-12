package fr.upsilon.inventirap;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Iterator;
import java.util.List;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.ExpandableListActivity;
import android.app.ListActivity;
import android.content.Context;
import android.os.Bundle;
import android.util.Log;
import android.widget.ExpandableListAdapter;
import android.widget.ListAdapter;
import android.widget.SimpleExpandableListAdapter;

public class DisplayExtendedResultActivity extends ExpandableListActivity {
	
	private Context context;
	private ExpandableListAdapter adapter;
	private ArrayList<HashMap<String, String>> groupList = new ArrayList<HashMap<String, String>>();
    ArrayList<ArrayList<HashMap<String, String>>> childList= new ArrayList<ArrayList<HashMap<String,String>>>();
	ArrayList<HashMap<String, String>> internalMap = new ArrayList<HashMap<String,String>>();

	
    /** Called when the activity is first created. */
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.expandable_display_result);
        
        context = this;
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
        	
        	HashMap<String, String> mapGroup = new HashMap<String, String>();
	        groupList.add(mapGroup);
        	// get value
			try {		
				value = json.getString(name);
				Log.d("", "get :" + name);
				
				/*HashMap<String, String> mapGroup = new HashMap<String, String>();
		        mapGroup.put("row",name);
		        groupList.add(mapGroup);*/
				
				if (name.compareTo("Category") == 0) {
					value = json.getJSONObject("Category").getString("nom");
				} else if (name.compareTo("SousCategory") == 0) {
					value = json.getJSONObject("SousCategory").getString("nom");
				} else if (name.compareTo("WorkGroup") == 0) {
					value = json.getJSONObject("WorkGroup").getString("nom");
				} else if (name.compareTo("ThematicGroup") == 0) {
					value = json.getJSONObject("ThematicGroup").getString("nom");
				} else if (name.compareTo("Materiel") == 0) {
					JSONObject material = json.getJSONObject("Materiel");
					for (Iterator<String> it2 = material.keys() ; it2.hasNext() ; ) {
						String name2 = it2.next();
						if (name2.endsWith("_id") || name2.equals("id") || name2.equals("lieu_stockage")
								|| name2.equals("lieu_detail"))
							continue;
						String value2 = material.getString(name2);
						
			        	HashMap<String, String> map2 = new HashMap<String, String>();
						
						map2.put("1", name2);
						map2.put("2", value2);
						internalMap.add(map2);
					}
					
					childList.add(internalMap);
					
				}
				
			} catch (JSONException e) {
			}

			if (name.compareTo("Materiel") == 0) {
				
			} else {
	        	map.put("1", "name");
	        	map.put("2", value);
	        	
	        	internalMap.add(map);
	        	
	        	childList.add(internalMap);
			}
        }
        	
        adapter = new SimpleExpandableListAdapter(context, 
        		groupList, R.layout.group_row, new String[] {"row"}, new int[] {R.id.row_name},
        		childList, R.layout.element, new String[] {"1", "2"}, new int[] {R.id.field1, R.id.field2});
        setListAdapter(adapter);
        
    }
    
    
}