package fr.upsilon.inventirap;

import java.util.ArrayList;
import java.util.HashMap;

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

public class DisplayResultActivity extends ListActivity {

	private Context context;
	private ListAdapter adapter;
	ArrayList<HashMap<String, String>> childList = new ArrayList<HashMap<String, String>>();

	/** Called when the activity is first created. */
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.display_result);

		context = this;

		Button buttonPlus = (Button) findViewById(R.id.buttonPlus);
		buttonPlus.setOnClickListener(new OnClickListener() {

			public void onClick(View v) {
				// start expandable view
				Intent intent = new Intent(context,
						DisplayExtendedResultActivity.class);
				startActivity(intent);

			}
		});

		JSONObject json = WebServicesTools.jsonObj;
		JSONObject material = null;
		try {
			JSONArray jsonArray = json.getJSONArray("materials");
			json = jsonArray.getJSONObject(0);
			material = json.getJSONObject("Materiel");

			// String j = json.getString("materials");
			// Log.d("", (String)json.keys().next());
			// Log.d("", j);
			// json = new JSONObject(j);
		} catch (JSONException e1) {
			finish();
		}
		int length = json.length();

		Log.d("", "json length : " + length);

		// get value
		try {

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
			map6.put("1", "Email du responsable");
			map6.put("2", material.getString("email_responsable"));
			childList.add(map6);

			HashMap<String, String> map7 = new HashMap<String, String>();
			map7.put("1", "Lieu");
			map7.put("2", material.getString("full_storage"));
			childList.add(map7);

		} catch (JSONException e) {}

		adapter = new SimpleAdapter(context, childList, R.layout.element,
				new String[] { "1", "2" },
				new int[] { R.id.field1, R.id.field2 });
		setListAdapter(adapter);

	}

}