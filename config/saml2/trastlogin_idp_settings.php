<?php

// If you choose to use ENV vars to define these values, give this IdP its own env var names
// so you can define different values for each IdP, all starting with 'SAML2_'.$this_idp_env_id
$this_idp_env_id = 'TEST';

//This is variable is for simplesaml example only.
// For real IdP, you must set the url values in the 'idp' config to conform to the IdP's real urls.
$idp_host = env('SAML2_'.$this_idp_env_id.'_IDP_HOST', 'http://localhost:8000/simplesaml');

return $settings = array(

    /*****
     * One Login Settings
     */

    // If 'strict' is True, then the PHP Toolkit will reject unsigned
    // or unencrypted messages if it expects them signed or encrypted
    // Also will reject the messages if not strictly follow the SAML
    // standard: Destination, NameId, Conditions ... are validated too.
    'strict' => true, //@todo: make this depend on laravel config

    // Enable debug mode (to print errors)
    'debug' => env('APP_DEBUG', false),

    // Service Provider Data that we are deploying
    'sp' => array(

        // Specifies constraints on the name identifier to be used to
        // represent the requested subject.
        // Take a look on lib/Saml2/Constants.php to see the NameIdFormat supported
        'NameIDFormat' => 'urn:oasis:names:tc:SAML:2.0:nameid-format:persistent',

        // Usually x509cert and privateKey of the SP are provided by files placed at
        // the certs folder. But we can also provide them with the following parameters
        'x509cert' => env('SAML2_'.$this_idp_env_id.'_SP_x509', ''),
        'privateKey' => env('SAML2_'.$this_idp_env_id.'_SP_PRIVATEKEY', ''),

        // Identifier (URI) of the SP entity.
        // Leave blank to use the '{idpName}_metadata' route, e.g. 'test_metadata'.
        'entityId' => 'http://localhost:8000/saml2/trastlogin/metadata',

        // Specifies info about where and how the <AuthnResponse> message MUST be
        // returned to the requester, in this case our SP.
        'assertionConsumerService' => array(
            // URL Location where the <Response> from the IdP will be returned,
            // using HTTP-POST binding.
            // Leave blank to use the '{idpName}_acs' route, e.g. 'test_acs'
            'url' => 'http://localhost:8000/saml2/trastlogin/acs',
        ),
        // Specifies info about where and how the <Logout Response> message MUST be
        // returned to the requester, in this case our SP.
        // Remove this part to not include any URL Location in the metadata.
        'singleLogoutService' => array(
            // URL Location where the <Response> from the IdP will be returned,
            // using HTTP-Redirect binding.
            // Leave blank to use the '{idpName}_sls' route, e.g. 'test_sls'
            'url' => '',
        ),
    ),

    // Identity Provider Data that we want connect with our SP
    'idp' => array(
        // Identifier of the IdP entity  (must be a URI)
        'entityId' =>  'https://portal.trustlogin.com/yamamoto-1127/idp/65108/saml',
        // SSO endpoint info of the IdP. (Authentication Request protocol)
        'singleSignOnService' => array(
            // URL Target of the IdP where the SP will send the Authentication Request Message,
            // using HTTP-Redirect binding.
            'url' => 'https://portal.trustlogin.com/yamamoto-1127/idp/65108/saml/auth',
        ),
        // SLO endpoint info of the IdP.
        'singleLogoutService' => array(
            // URL Location of the IdP where the SP will send the SLO Request,
            // using HTTP-Redirect binding.
            'url' => env('SAML2_'.$this_idp_env_id.'_IDP_SL_URL', $idp_host . '/saml2/idp/SingleLogoutService.php'),
        ),
        // Public x509 certificate of the IdP
        'x509cert' => 'MIIDPTCCAiWgAwIBAgIVAOMEtqM5MWDW38cOhIfhsjGRpB2KMA0GCSqGSIb3DQEB
        CwUAMFgxCzAJBgNVBAYTAkpQMRwwGgYDVQQKDBNHTU8gR2xvYmFsU2lnbiBLLksu
        MRMwEQYDVQQLDApUcnVzdExvZ2luMRYwFAYDVQQDDA15YW1hbW90by0xMTI3MB4X
        DTIxMDgyMTE3MDUyNFoXDTMxMDgyMTE3MDUyNFowWDELMAkGA1UEBhMCSlAxHDAa
        BgNVBAoME0dNTyBHbG9iYWxTaWduIEsuSy4xEzARBgNVBAsMClRydXN0TG9naW4x
        FjAUBgNVBAMMDXlhbWFtb3RvLTExMjcwggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAw
        ggEKAoIBAQCj0GpIRbHU+/cD2oNDv+WEmgJLnX4IotS61E9EDbIhwyqSrjcYLim4
        t7IaS+XUZ6822fQNNA+u4GBRMm8DGtru54A97QpbQfG6Shqb69HJO6mbVVVRf14r
        X+pPYksci4//sVSg9Fip3QQ0jCeSQr2hMc4aCw2s6CWjVtgZB/btPbC5BXr55Y0v
        kKURKubyGunNdC+yx9FOBrtIIo1/z6isLJv/PO9e+1m62pQc6HKgVe+yj0Qb1DNi
        jA5q/jwXP906G45I5uFPI7AzLmwL8i6HIX9vQFTK3EnIdKX8zU1fVGmMF0ft1Gxb
        uRt2cxmWawflRX5csbh4x8cspz6sKswhAgMBAAEwDQYJKoZIhvcNAQELBQADggEB
        AKO2T90Dk90LhdAWn9/o5iJKDyQkMYl0VUbTLbuxfL9428lY86R7UAK/ikSMy6aA
        sQ5D4Lnx7278DfQzu74nLOcBB/gkSt8xsdmObCHKgIeKTyY3vYVCQljBz08dWR9Y
        WKwqJ6UzDvq0lf/LdCaCQ8rDa/LIwqTlRCSzcfk7NUWXeNe95JhOG/gjjdXw2YHf
        OfEi3Bv6NClU2X9tZlsGEkxOYh84N2FGgsN+0s09zOrIn2hveBpxljgxLDv7QTvN
        0BdlY7AilnkL7bLEzWP7LBZCWVfgu77kNlXR8ZF+rsBqowzInfW9x5NrOZ7XZ1TI
        3ocszKgFRq7TQpbZhwV/zsA='
        /*
         *  Instead of use the whole x509cert you can use a fingerprint
         *  (openssl x509 -noout -fingerprint -in "idp.crt" to generate it)
         */
        // 'certFingerprint' => '',
    ),



    /***
     *
     *  OneLogin advanced settings
     *
     *
     */
    // Security settings
    'security' => array(

        /** signatures and encryptions offered */

        // Indicates that the nameID of the <samlp:logoutRequest> sent by this SP
        // will be encrypted.
        'nameIdEncrypted' => false,

        // Indicates whether the <samlp:AuthnRequest> messages sent by this SP
        // will be signed.              [The Metadata of the SP will offer this info]
        'authnRequestsSigned' => false,

        // Indicates whether the <samlp:logoutRequest> messages sent by this SP
        // will be signed.
        'logoutRequestSigned' => false,

        // Indicates whether the <samlp:logoutResponse> messages sent by this SP
        // will be signed.
        'logoutResponseSigned' => false,

        /* Sign the Metadata
         False || True (use sp certs) || array (
                                                    keyFileName => 'metadata.key',
                                                    certFileName => 'metadata.crt'
                                                )
        */
        'signMetadata' => false,


        /** signatures and encryptions required **/

        // Indicates a requirement for the <samlp:Response>, <samlp:LogoutRequest> and
        // <samlp:LogoutResponse> elements received by this SP to be signed.
        'wantMessagesSigned' => false,

        // Indicates a requirement for the <saml:Assertion> elements received by
        // this SP to be signed.        [The Metadata of the SP will offer this info]
        'wantAssertionsSigned' => false,

        // Indicates a requirement for the NameID received by
        // this SP to be encrypted.
        'wantNameIdEncrypted' => false,

        // Authentication context.
        // Set to false and no AuthContext will be sent in the AuthNRequest,
        // Set true or don't present thi parameter and you will get an AuthContext 'exact' 'urn:oasis:names:tc:SAML:2.0:ac:classes:PasswordProtectedTransport'
        // Set an array with the possible auth context values: array ('urn:oasis:names:tc:SAML:2.0:ac:classes:Password', 'urn:oasis:names:tc:SAML:2.0:ac:classes:X509'),
        'requestedAuthnContext' => true,
    ),

    // Contact information template, it is recommended to suply a technical and support contacts
    'contactPerson' => array(
        'technical' => array(
            'givenName' => 'name',
            'emailAddress' => 'no@reply.com'
        ),
        'support' => array(
            'givenName' => 'Support',
            'emailAddress' => 'no@reply.com'
        ),
    ),

    // Organization information template, the info in en_US lang is recomended, add more if required
    'organization' => array(
        'en-US' => array(
            'name' => 'Name',
            'displayname' => 'Display Name',
            'url' => 'http://url'
        ),
    ),

/* Interoperable SAML 2.0 Web Browser SSO Profile [saml2int]   http://saml2int.org/profile/current

   'authnRequestsSigned' => false,    // SP SHOULD NOT sign the <samlp:AuthnRequest>,
                                      // MUST NOT assume that the IdP validates the sign
   'wantAssertionsSigned' => true,
   'wantAssertionsEncrypted' => true, // MUST be enabled if SSL/HTTPs is disabled
   'wantNameIdEncrypted' => false,
*/

);
