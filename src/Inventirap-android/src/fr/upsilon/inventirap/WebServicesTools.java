package fr.upsilon.inventirap;

import java.io.IOException;
import java.io.InputStream;
import java.io.StringReader;

import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.parsers.ParserConfigurationException;

import org.apache.http.HttpEntity;
import org.apache.http.HttpHost;
import org.apache.http.HttpResponse;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;
import org.w3c.dom.Document;
import org.xml.sax.InputSource;
import org.xml.sax.SAXException;

import android.content.Context;

public class WebServicesTools {
	public static Document document;

	public static String getXML(Context context, String url, int content) {
		String line = null;
		
		DefaultHttpClient httpClient = new DefaultHttpClient();
		
		HttpPost httpPost = new HttpPost(url);
		HttpResponse httpResponse;
		try {
			httpResponse = httpClient.execute(httpPost);
			HttpEntity httpEntity = httpResponse.getEntity();
			line = EntityUtils.toString(httpEntity);
		} catch (ClientProtocolException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		return line;
	}
	
	public static boolean XMLFromString(String xml) {
		
		DocumentBuilderFactory dbf = DocumentBuilderFactory.newInstance();
		try {
			DocumentBuilder db = dbf.newDocumentBuilder();
			
			InputSource is = new InputSource();
			is.setCharacterStream(new StringReader(xml));
			document = db.parse(is);
		} catch (Exception e) {
			return false;
		}
		
		return true;
	}
}
