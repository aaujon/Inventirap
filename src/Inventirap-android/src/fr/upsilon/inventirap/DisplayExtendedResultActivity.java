package fr.upsilon.inventirap;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Iterator;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.ExpandableListActivity;
import android.content.Context;
import android.os.Bundle;
import android.util.Log;
import android.widget.ExpandableListAdapter;
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
		} catch (JSONException e1) {
			finish();
		}
        int length = json.length();

        Log.d("", "json length : "+length);
        
        Iterator it = json.keys();
        while (it.hasNext()) {
        	String name = (String) it.next();
        	
        	HashMap<String, String> mapGroup = new HashMap<String, String>();
        	mapGroup.put("row", name);
	        groupList.add(mapGroup);
	    	ArrayList<HashMap<String, String>> internalMap = new ArrayList<HashMap<String,String>>();

        	// get value
			try {		
				Log.d("", "get :" + name);
				
				if (name.compareTo("Categorie") == 0) {
					JSONObject material = json.getJSONObject("Categorie");
					for (Iterator<String> it2 = material.keys() ; it2.hasNext() ; ) {
						String name2 = it2.next();
						if (name2.equals("id"))
							continue;
						String value2 = material.getString(name2);
						
			        	HashMap<String, String> map2 = new HashMap<String, String>();
						
						map2.put("1", name2);
						map2.put("2", value2);
						internalMap.add(map2);
					}
					//value = json.getJSONObject("Categorie").getString("nom");
				} else if (name.compareTo("SousCategorie") == 0) {
					JSONObject material = json.getJSONObject("SousCategorie");
					for (Iterator<String> it2 = material.keys() ; it2.hasNext() ; ) {
						String name2 = it2.next();
						if (name2.endsWith("_id") || name2.equals("id"))
							continue;
						String value2 = material.getString(name2);
						
			        	HashMap<String, String> map2 = new HashMap<String, String>();
						
						map2.put("1", name2);
						map2.put("2", value2);
						internalMap.add(map2);
					}
					//value = json.getJSONObject("SousCategorie").getString("nom");
				} else if (name.compareTo("GroupesTravail") == 0) {
					JSONObject material = json.getJSONObject("GroupesTravail");
					
					String value2 = material.getString("nom");
						
			        HashMap<String, String> map2 = new HashMap<String, String>();
						
					map2.put("1", "nom");
					map2.put("2", value2);
					internalMap.add(map2);

					//value = json.getJSONObject("GroupesTravail").getString("nom");
				} else if (name.compareTo("GroupesThematique") == 0) {
					JSONObject material = json.getJSONObject("GroupesThematique");
					
					String value2 = material.getString("nom");
						
			        HashMap<String, String> map2 = new HashMap<String, String>();
						
					map2.put("1", "nom");
					map2.put("2", value2);
					internalMap.add(map2);
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
					
					//childList.add(internalMap);
					
				}
				
			} catch (JSONException e) {}
    	
	        	childList.add(internalMap);
        }
        	
        adapter = new SimpleExpandableListAdapter(context, 
        		groupList, R.layout.group_row, new String[] {"row"}, new int[] {R.id.row_name},
        		childList, R.layout.element, new String[] {"1", "2"}, new int[] {R.id.field1, R.id.field2});
        setListAdapter(adapter);
        
    }
    
    
}