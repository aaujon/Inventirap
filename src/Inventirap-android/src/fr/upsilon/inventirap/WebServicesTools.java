package fr.upsilon.inventirap;

import java.io.IOException;
import java.net.HttpURLConnection;
import java.net.URI;
import java.net.URL;
import java.net.URLEncoder;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.HttpVersion;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.conn.ClientConnectionManager;
import org.apache.http.conn.scheme.PlainSocketFactory;
import org.apache.http.conn.scheme.Scheme;
import org.apache.http.conn.scheme.SchemeRegistry;
import org.apache.http.conn.ssl.SSLSocketFactory;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.impl.conn.tsccm.ThreadSafeClientConnManager;
import org.apache.http.params.BasicHttpParams;
import org.apache.http.params.HttpParams;
import org.apache.http.params.HttpProtocolParams;
import org.apache.http.protocol.HTTP;
import org.apache.http.util.EntityUtils;
import org.json.JSONException;
import org.json.JSONObject;

import android.content.Context;
import android.net.Uri;
import android.os.Parcelable.Creator;
import android.util.Log;

public class WebServicesTools {
	public static JSONObject jsonObj;
	private static String WEBSERVICE_ADDRESS = "/ServicesWeb/materiel/";

	public static String getXML(Context context, String url, String content, String login, String pass) throws Exception {
		String line = null;
		
		
		HttpClient httpClient = createHttpClient();
		URL realUrl = new URL(url+WEBSERVICE_ADDRESS+content+"/"+login+"/"+pass);
		//URL realUrl = new URL("https://pierrickmarie.info/");

		Log.d("", "WebService call : " + url+WEBSERVICE_ADDRESS+content+"/"+login+"/"+pass);
		//String urlEncoded = url.replace("==", "%3D%3D");
		Log.d("", "WebService call encoded: " + realUrl);
		//URI uri = new URI(url);
		//URLEncoder.encode(url+WEBSERVICE_ADDRESS+content+"/"+login+"/"+pass);
		HttpPost httpPost = new HttpPost(realUrl.toURI());
		HttpResponse httpResponse;

		httpResponse = httpClient.execute(httpPost);
		HttpEntity httpEntity = httpResponse.getEntity();
		line = EntityUtils.toString(httpEntity);
		
		return line;
	}
	
	public static boolean JSONFromString(String json) {
		try {
			jsonObj = new JSONObject(json);
			//jsonObj = jsonObj.optJSONObject("materials");
		} catch (JSONException e) {
			return false;
		}
		return true;
	}
	
	private static HttpClient createHttpClient() {
	    HttpParams params = new BasicHttpParams();
	    HttpProtocolParams.setVersion(params, HttpVersion.HTTP_1_1);
	    HttpProtocolParams.setContentCharset(params, HTTP.DEFAULT_CONTENT_CHARSET);
	    HttpProtocolParams.setUseExpectContinue(params, true);

	    SchemeRegistry schReg = new SchemeRegistry();
	    schReg.register(new Scheme("http", PlainSocketFactory.getSocketFactory(), 80));
	    schReg.register(new Scheme("https", SSLSocketFactory.getSocketFactory(), 443));
	    ClientConnectionManager conMgr = new ThreadSafeClientConnManager(params, schReg);

	    return new DefaultHttpClient(conMgr, params);
	}

}
