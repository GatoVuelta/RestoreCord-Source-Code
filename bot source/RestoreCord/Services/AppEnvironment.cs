using System;
using System.Collections.Generic;

// Define global environment variables here
public static class AppEnvironment
{
    // API
    public static string API_URL = Environment.GetEnvironmentVariable("GREMLINS_API_URL");
    public static string BOT_REDIRECT_URI = API_URL + "/auth/";
    public static string BOT_VERIFY_URI = API_URL + "/verify/";

    // Bot
    public static string BOT_TOKEN = Environment.GetEnvironmentVariable("GREMLINS_BOT_TOKEN");
    public static string BOT_CLIENT_ID = Environment.GetEnvironmentVariable("GREMLINS_BOT_CLIENT_ID");
    public static string BOT_CLIENT_SECRET = Environment.GetEnvironmentVariable("GREMLINS_BOT_CLIENT_SECRET");

    // Database
    public static string DB_HOST = Environment.GetEnvironmentVariable("GREMLINS_DB_HOST");
    public static string DB_PORT = Environment.GetEnvironmentVariable("GREMLINS_DB_PORT");
    public static string DB_USER = Environment.GetEnvironmentVariable("GREMLINS_DB_USER");
    public static string DB_PASS = Environment.GetEnvironmentVariable("GREMLINS_DB_PASS");
    public static string DB_NAME = Environment.GetEnvironmentVariable("GREMLINS_DB_NAME");

    // Function that checks if all of them are set
    public static bool Check()
    {   
        var missing = new List<string>();
        if (API_URL == null) missing.Add("GREMLINS_API_URL");
        if (BOT_TOKEN == null) missing.Add("GREMLINS_BOT_TOKEN");
        if (BOT_CLIENT_ID == null) missing.Add("GREMLINS_BOT_CLIENT_ID");
        if (BOT_CLIENT_SECRET == null) missing.Add("GREMLINS_BOT_CLIENT_SECRET");
        if (DB_HOST == null) missing.Add("GREMLINS_DB_HOST");
        if (DB_PORT == null) missing.Add("GREMLINS_DB_PORT");
        if (DB_USER == null) missing.Add("GREMLINS_DB_USER");
        if (DB_PASS == null) missing.Add("GREMLINS_DB_PASS");
        if (DB_NAME == null) missing.Add("GREMLINS_DB_NAME");
        if (missing.Count > 0)
            Console.WriteLine("Missing environment variables: " + string.Join(", ", missing));
        return API_URL != null && BOT_TOKEN != null && BOT_CLIENT_ID != null && BOT_CLIENT_SECRET != null && DB_HOST != null && DB_PORT != null && DB_USER != null && DB_PASS != null && DB_NAME != null;
    }
}