<?php

$settings = array (
    // If 'strict' is True, then the PHP Toolkit will reject unsigned
    // or unencrypted messages if it expects them signed or encrypted
    // Also will reject the messages if not strictly follow the SAML
    // standard: Destination, NameId, Conditions ... are validated too.
    'strict' => false,

    // Enable debug mode (to print errors)
    'debug' => false,

    // Set a BaseURL to be used instead of try to guess
    // the BaseURL of the view that process the SAML Message.
    // Ex. http://sp.example.com/
    //     http://example.com/sp/
    'baseurl' => 'https://ec2-54-69-83-188.us-west-2.compute.amazonaws.com',

    // Service Provider Data that we are deploying
    'sp' => array (
        // Identifier of the SP entity  (must be a URI)
        'entityId' => 'https://ec2-54-69-83-188.us-west-2.compute.amazonaws.com/demo1',
        // Specifies info about where and how the <AuthnResponse> message MUST be
        // returned to the requester, in this case our SP.
        'assertionConsumerService' => array (
            // URL Location where the <Response> from the IdP will be returned
            'url' => 'https://ec2-54-69-83-188.us-west-2.compute.amazonaws.com/saml/index.php?acs',
            // SAML protocol binding to be used when returning the <Response>
            // message.  Onelogin Toolkit supports for this endpoint the
            // HTTP-Redirect binding only
            'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
        ),
        // If you need to specify requested attributes, set a
        // attributeConsumingService. nameFormat, attributeValue and
        // friendlyName can be omitted. Otherwise remove this section.
        //"attributeConsumingService"=> array(
        //        "ServiceName" => "SP test",
        //        "serviceDescription" => "Test Service",
        //        "requestedAttributes" => array(
        //            array(
        //                "name" => "",
        //                "isRequired" => false,
        //                "nameFormat" => "",
        //                "friendlyName" => "",
        //                "attributeValue" => ""
        //            )
        //        )
        //),
        // Specifies info about where and how the <Logout Response> message MUST be
        // returned to the requester, in this case our SP.
        'singleLogoutService' => array (
            // URL Location where the <Response> from the IdP will be returned
            'url' => 'https://ec2-54-69-83-188.us-west-2.compute.amazonaws.com/saml/index.php?slo',
            // SAML protocol binding to be used when returning the <Response>
            // message.  Onelogin Toolkit supports for this endpoint the
            // HTTP-Redirect binding only
            'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
        ),
        // Specifies constraints on the name identifier to be used to
        // represent the requested subject.
        // Take a look on lib/Saml2/Constants.php to see the NameIdFormat supported
        'NameIDFormat' => 'urn:oasis:names:tc:SAML:1.1:nameid-format:unspecified',

        // Usually x509cert and privateKey of the SP are provided by files placed at
        // the certs folder. But we can also provide them with the following parameters
        //'x509cert' => '',
        //'privateKey' => '',

        /*
         * Key rollover
         * If you plan to update the SP x509cert and privateKey
         * you can define here the new x509cert and it will be 
         * published on the SP metadata so Identity Providers can
         * read them and get ready for rollover.
         */
        // 'x509certNew' => '',
    ),

    // Identity Provider Data that we want connect with our SP
    'idp' => array (
        // Identifier of the IdP entity  (must be a URI)
        'entityId' => 'https://ec2-54-69-83-188.us-west-2.compute.amazonaws.com/simplesaml/saml2/idp/metadata.php',
        // SSO endpoint info of the IdP. (Authentication Request protocol)
        'singleSignOnService' => array (
            // URL Target of the IdP where the SP will send the Authentication Request Message
            'url' => 'https://ec2-54-69-83-188.us-west-2.compute.amazonaws.com/simplesaml/saml2/idp/SSOService.php',
            // SAML protocol binding to be used when returning the <Response>
            // message.  Onelogin Toolkit supports for this endpoint the
            // HTTP-POST binding only
            //'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
            'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
        ),
        // SLO endpoint info of the IdP.
        'singleLogoutService' => array (
            // URL Location of the IdP where the SP will send the SLO Request
            'url' => 'https://ec2-54-69-83-188.us-west-2.compute.amazonaws.com/simplesaml/saml2/idp/SingleLogoutService.php',
            // SAML protocol binding to be used when returning the <Response>
            // message.  Onelogin Toolkit supports for this endpoint the
            // HTTP-Redirect binding only
            'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
        ),
        // Public x509 certificate of the IdP
        'x509cert' => 'MIIEKzCCAxOgAwIBAgIJAJ2JJlU+OLyRMA0GCSqGSIb3DQEBCwUAMIGrMQswCQYDVQQGEwJVUzENMAsGA1UECAwET2hpbzEPMA0GA1UEBwwGQXRoZW5zMRgwFgYDVQQKDA9JRE0gSW50ZWdyYXRpb24xOTA3BgNVBAMMMGVjMi01NC02OS04My0xODgudXMtd2VzdC0yLmNvbXB1dGUuYW1hem9uYXdzLmNvbTEnMCUGCSqGSIb3DQEJARYYZGF2aWRAaWRtaW50ZWdyYXRpb24uY29tMB4XDTE1MDcyMzAwNTI1N1oXDTI1MDcyMjAwNTI1N1owgasxCzAJBgNVBAYTAlVTMQ0wCwYDVQQIDARPaGlvMQ8wDQYDVQQHDAZBdGhlbnMxGDAWBgNVBAoMD0lETSBJbnRlZ3JhdGlvbjE5MDcGA1UEAwwwZWMyLTU0LTY5LTgzLTE4OC51cy13ZXN0LTIuY29tcHV0ZS5hbWF6b25hd3MuY29tMScwJQYJKoZIhvcNAQkBFhhkYXZpZEBpZG1pbnRlZ3JhdGlvbi5jb20wggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQDLMEcRKoIjfeXM7Ovd4VbF2vuet0EfIAn/Ovqpdw0DBD+3HH/L2ZWX7JnWf/JySkuIn7fyCJNUhLrYXlVxif6zPBBDQqW2nFCLvINxWauWP8hA6mHWijV7eNg4trvrpkOyEZioVcjRzBan2WP+yd3wQYTbOR3LATi97gTWq//EldH5spLLq2eTHAoxHYGDPVJegIt19aE9l4dnGuBcTER4pcHkb3sF3u40lNNPcJRcwfrvw32qX9nKNXdutOR+UyA9e65RJmOuWKQ3yS6KmWB9kkJdY2bFIG9CqRODl4hdPsOl+uqzx/GNxDy6o3B6UGvAw+RtRkZGZzPWx3rR2jHzAgMBAAGjUDBOMB0GA1UdDgQWBBTmd4lNnf7tkkfTvUH7HqqFgIAFpDAfBgNVHSMEGDAWgBTmd4lNnf7tkkfTvUH7HqqFgIAFpDAMBgNVHRMEBTADAQH/MA0GCSqGSIb3DQEBCwUAA4IBAQBYSymVUEeDhQKFJxnHHitReAnN7aoSTav5M8CQI+EgQQ5PwIr0UyD1NZlNVkz1q77r5gA+NkDKcsPQ/WbNTi1qW1gBSejDRouXkP5Zy+Hnj8b1QEXvyRZtMiFF++CW9LVtEN60bAcpaoTr4J7KJLNPUOho/c1ja5rbyuTm8Vrga1jwXmL/EE6zE+9hpnwoZZdCViFdqaSkW4MZl0iSwwWkBuQB9b3gataaRRCN1bLKelJvC6iQMU22Ilsp4snGzAceYr02eoCh/sS8yeiZoJNkq/auBuTWCSu1ilCDvIMAx+pIMvl9I3k9aPvVGF6oebvCS25Wl5vPkvvOIYibHdCW',
        /*
         *  Instead of use the whole x509cert you can use a fingerprint
         *  (openssl x509 -noout -fingerprint -in "idp.crt" to generate it,
         *   or add for example the -sha256 , -sha384 or -sha512 parameter)
         *
         *  If a fingerprint is provided, then the certFingerprintAlgorithm is required in order to
         *  let the toolkit know which Algorithm was used. Possible values: sha1, sha256, sha384 or sha512
         *  'sha1' is the default value.
         */
        // 'certFingerprint' => '',
        // 'certFingerprintAlgorithm' => 'sha1',

        /* In some scenarios the IdP uses different certificates for
         * signing/encryption, or is under key rollover phase and more 
         * than one certificate is published on IdP metadata.
         * In order to handle that the toolkit offers that parameter.
         * (when used, 'x509cert' and 'certFingerprint' values are
         * ignored).
         */
        // 'x509certMulti' => array(
        //      'signing' => array(
        //          0 => '<cert1-string>',
        //      ),
        //      'encryption' => array(
        //          0 => '<cert2-string>',
        //      )
        // ),
    ),
);
