package fr.upsilon.inventirap;

import java.io.PrintWriter;
import java.net.HttpURLConnection;
import java.net.URL;
import java.security.cert.CertificateException;
import java.security.cert.X509Certificate;
import java.util.Scanner;

import javax.net.ssl.HostnameVerifier;
import javax.net.ssl.HttpsURLConnection;
import javax.net.ssl.SSLContext;
import javax.net.ssl.SSLSession;
import javax.net.ssl.TrustManager;
import javax.net.ssl.X509TrustManager;

import org.json.JSONException;
import org.json.JSONObject;

import android.content.Context;
import android.util.Log;

public class WebServicesTools {
	public static JSONObject jsonObj;
	private static String WEBSERVICE_ADDRESS = "/ServicesWeb/materiel/";

	public static String getXML(Context context, String url, String content, String login, String pass) throws Exception {
		//String line = null;
		  
		URL realUrl = new URL(url+WEBSERVICE_ADDRESS+content+"/"+login+"/"+pass);

		Log.d("", "WebService call : " + url+WEBSERVICE_ADDRESS+content+"/"+login+"/"+pass);
		Log.d("", "WebService call encoded: " + realUrl);
		
		HttpURLConnection conn;
		if (realUrl.getProtocol().toLowerCase().equals("https")) {
	        trustAllHosts();
	        HttpsURLConnection https = (HttpsURLConnection) realUrl.openConnection();
	        https.setHostnameVerifier(DO_NOT_VERIFY);
	        conn = https;
	    } else {
	        conn = (HttpURLConnection) realUrl.openConnection();
	    }

		conn.setDoOutput(true);
		conn.setRequestMethod("POST");
		
		PrintWriter out = new PrintWriter(conn.getOutputStream());
		out.print("");
		out.close();
		
		String response= "";

		//start listening to the stream
		Scanner inStream = new Scanner(conn.getInputStream());

		//process the stream and store it in StringBuilder
		while(inStream.hasNextLine())
		response+=(inStream.nextLine());
		
		return response;
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

	// always verify the host - dont check for certificate
    final static HostnameVerifier DO_NOT_VERIFY = new HostnameVerifier() {
          public boolean verify(String hostname, SSLSession session) {
              return true;
          }
   };

    /**
     * Trust every server - dont check for any certificate
     */
    private static void trustAllHosts() {
              // Create a trust manager that does not validate certificate chains
              TrustManager[] trustAllCerts = new TrustManager[] { new X509TrustManager() {
                      public java.security.cert.X509Certificate[] getAcceptedIssuers() {
                              return new java.security.cert.X509Certificate[] {};
                      }

                      public void checkClientTrusted(X509Certificate[] chain,
                                      String authType) throws CertificateException {
                      }

                      public void checkServerTrusted(X509Certificate[] chain,
                                      String authType) throws CertificateException {
                      }
              } };

              // Install the all-trusting trust manager
              try {
                      SSLContext sc = SSLContext.getInstance("TLS");
                      sc.init(null, trustAllCerts, new java.security.SecureRandom());
                      HttpsURLConnection
                                      .setDefaultSSLSocketFactory(sc.getSocketFactory());
              } catch (Exception e) {
                      e.printStackTrace();
              }
      }



}
