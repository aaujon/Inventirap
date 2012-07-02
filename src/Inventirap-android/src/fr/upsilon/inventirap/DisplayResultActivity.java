package fr.upsilon.inventirap;

import java.util.ArrayList;
import java.util.HashMap;

import org.w3c.dom.Document;
import org.w3c.dom.Element;
import org.w3c.dom.NodeList;

import android.app.Activity;
import android.app.ListActivity;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.widget.ListAdapter;
import android.widget.ListView;
import android.widget.SimpleAdapter;

public class DisplayResultActivity extends ListActivity {
	private final int QRCODE_RESULT = 0;
	
	private Context context;
	private ListAdapter adapter;
	
    /** Called when the activity is first created. */
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.display_result);
        
        context = this;
        Document document = WebServicesTools.document;
        NodeList nodeList = document.getFirstChild().getChildNodes();
        int nodeNumber = nodeList.getLength();
        Log.d("", "node number : "+nodeNumber);
        
        ArrayList<HashMap<String, String>> myList= new ArrayList<HashMap<String,String>>();
        for (int i = 0 ; i < nodeNumber ; i++) {
        	HashMap<String, String> map = new HashMap<String, String>();
        	
        	Element e = (Element) nodeList.item(i);
        	map.put("1", e.getNodeName());
        	map.put("2", e.getChildNodes().item(0).getNodeValue());
        	
        	myList.add(map);
        }
        
        adapter = new SimpleAdapter(context, myList, R.layout.element,
        		new String[] {"1", "2"},
        		new int[] {R.id.field1, R.id.field2});
        		
  
        setListAdapter(adapter);
        
    }
    
    
}