<?php

namespace LCStudios\LdapBundle\Security\User;

use Symfony\Component\Security\Core\User\User;
use LCStudios\LdapBundle\Security\User\LdapUserInterface;

class LdapUser implements LdapUserInterface
{
    private $ldapListing;
    private $username;
    private $password;
    private $enabled;
    private $accountNonExpired;
    private $credentialsNonExpired;
    private $accountNonLocked;
    private $roles;
    private $attributes;

    public function __construct(
        $username,
        $password,
        array $roles = array(),
        array $attributes = array(),
        $enabled = true,
        $userNonExpired = true,
        $credentialsNonExpired = true,
        $userNonLocked = true
    ) {
        if (empty($username)) {
            throw new \InvalidArgumentException('The username cannot be empty.');
        }

        $this->username = $username;
        $this->password = $password;
        $this->enabled = $enabled;
        $this->accountNonExpired = $userNonExpired;
        $this->credentialsNonExpired = $credentialsNonExpired;
        $this->accountNonLocked = $userNonLocked;
        $this->roles = $roles;
        $this->attributes = $attributes;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * {@inheritdoc}
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * {@inheritdoc}
     */
    public function isAccountNonExpired()
    {
        return $this->accountNonExpired;
    }

    /**
     * {@inheritdoc}
     */
    public function isAccountNonLocked()
    {
        return $this->accountNonLocked;
    }

    /**
     * {@inheritdoc}
     */
    public function isCredentialsNonExpired()
    {
        return $this->credentialsNonExpired;
    }

    /**
     * {@inheritdoc}
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials()
    {
    }

    public function setLdapListing( array $listing )
    {
        $this->ldapListing = $listing;
    }

    public function getLdapListing()
    {
        return $this->ldapListing;
    }

    /**
     * @param $attribute
     * @return string
     */
    public function getAttribute($attribute) {
        if (array_key_exists($attribute, $this->attributes)) {
            return $this->attributes[$attribute];
        } else {
            return null;
        }
    }

    public function __get($field) {
        if (array_key_exists($field, $this->attributes)) {
            return $this->attributes[$field];
        }
    }
    // @todo maybe some getter/setter magic methods for the LDAP listing?
}
