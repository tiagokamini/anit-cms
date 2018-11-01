<?php
namespace Siteprivate\EmailConfig;

/**
 * Class EmailUpdateInfoConfig
 * @package Siteprivate\EmailConfig
 * set your smtp configuration for an email address used by users to send a request to update contact information
 */
class EmailUpdateInfoConfig{
    /**
     * @var string
     */
    public static $emailAdressForContact = "foo.bar@foo.bar";
    /**
     * @var string
     */
    public static $smtpServerNameForContact = "smtp.foo.bar";
    /**
     * @var string
     */
    public static $smtpHostServerForContact = "smtp.foo.bar";
    /**
     * @var string
     */
    public static $smtpHostPortForContact = "465";
    /**
     * @var string
     */
    public static $connectionClassForContact = "foologin";
    /**
     * @var string
     */
    public static $connectionConfigUsernameForContact = "foo.bar";
    /**
     * @var string
     */
    public static $connectionConfigPwdForContact = "foofoo";
    /**
     * @var string
     */
    public static $connectionConfigSSLForContact = "ssl";
}
