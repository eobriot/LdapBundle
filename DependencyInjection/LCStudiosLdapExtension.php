<?php

namespace LCStudios\LdapBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 *
 * @author Robin Gloster <robin.gloster@lcstudios.de>
 */
class LCStudiosLdapExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('lc_studios_ldap.host', $config['host']);
        $container->setParameter('lc_studios_ldap.port', $config['port']);
        $container->setParameter('lc_studios_ldap.uid', $config['uid']);
        $container->setParameter('lc_studios_ldap.base_dn', $config['base_dn']);
        $container->setParameter('lc_studios_ldap.authenticated_role', $config['authenticated_role']);
        $container->setParameter('lc_studios_ldap.bind_user.dn', $config['bind_user']['dn']);
        $container->setParameter('lc_studios_ldap.bind_user.password', $config['bind_user']['password']);
        $container->setParameter('lc_studios_ldap.filterAttributes', $config['filterAttributes']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
