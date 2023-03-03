<?php

return [

    /*
    * the clientId is set from the Microsoft portal to identify the application
    * https://apps.dev.microsoft.com
    */
    'clientId' => env('MSGRAPH_CLIENT_ID'),

    /*
    * set the application secret
    */

    'clientSecret' => env('MSGRAPH_SECRET_ID'),

    /*
    * Set the url to trigger the oauth process this url should call return MsGraph::connect();
    */
    'redirectUri' => env('MSGRAPH_OAUTH_URL'),

    /*
    set the token url
    */
    'urlAccessToken' => 'https://login.microsoftonline.com/'.env('MSGRAPH_TENANT_ID', 'common').'/oauth2/v2.0/token',

    /*
    set the scopes to be used, Microsoft Graph API will accept up to 20 scopes
    * https://graph.microsoft.com/.default or 
    * offline_access openid calendars.readwrite contacts.readwrite files.readwrite mail.readwrite mail.send tasks.readwrite mailboxsettings.readwrite user.readwrite
    */

    'scopes' => env('MSGRAPH_SCOPES', 'https://graph.microsoft.com/.default'),

    /*
    set the grant type
    */
    'grant_type' => env('MSGRAPH_GRANT_TYPE', 'client_credentials'),
];
