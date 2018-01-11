<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\DelegatingLoader;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Loader\LoaderResolver;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Loader\ClosureLoader;
use Symfony\Component\DependencyInjection\Loader\DirectoryLoader;
use Symfony\Component\DependencyInjection\Loader\IniFileLoader;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\Config\FileLocator;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            // Sylius bundles, part 1

            new Sylius\Bundle\OrderBundle\SyliusOrderBundle(),
            new Sylius\Bundle\MoneyBundle\SyliusMoneyBundle(),
            new Sylius\Bundle\CurrencyBundle\SyliusCurrencyBundle(),
            new Sylius\Bundle\LocaleBundle\SyliusLocaleBundle(),
            new Sylius\Bundle\ProductBundle\SyliusProductBundle(),
            new Sylius\Bundle\ChannelBundle\SyliusChannelBundle(),
            new Sylius\Bundle\AttributeBundle\SyliusAttributeBundle(),
            new Sylius\Bundle\TaxationBundle\SyliusTaxationBundle(),
            new Sylius\Bundle\ShippingBundle\SyliusShippingBundle(),
            new Sylius\Bundle\PaymentBundle\SyliusPaymentBundle(),
            new Sylius\Bundle\MailerBundle\SyliusMailerBundle(),
            new Sylius\Bundle\PromotionBundle\SyliusPromotionBundle(),
            new Sylius\Bundle\AddressingBundle\SyliusAddressingBundle(),
            new Sylius\Bundle\InventoryBundle\SyliusInventoryBundle(),
            new Sylius\Bundle\TaxonomyBundle\SyliusTaxonomyBundle(),
            new Sylius\Bundle\UserBundle\SyliusUserBundle(),
            new Sylius\Bundle\CustomerBundle\SyliusCustomerBundle(),
            new Sylius\Bundle\UiBundle\SyliusUiBundle(),
            new Sylius\Bundle\ReviewBundle\SyliusReviewBundle(),
            new Sylius\Bundle\CoreBundle\SyliusCoreBundle(),
            new Sylius\Bundle\ResourceBundle\SyliusResourceBundle(),
            new Sylius\Bundle\GridBundle\SyliusGridBundle(),
            new winzou\Bundle\StateMachineBundle\winzouStateMachineBundle(),

            new Doctrine\Bundle\DoctrineCacheBundle\DoctrineCacheBundle(),

            // Standard eZ Platform bundles

            // Symfony
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            // Dependencies
            new Hautelook\TemplatedUriBundle\HautelookTemplatedUriBundle(),
            new Liip\ImagineBundle\LiipImagineBundle(),
            new FOS\HttpCacheBundle\FOSHttpCacheBundle(),
            new Nelmio\CorsBundle\NelmioCorsBundle(),
            new Oneup\FlysystemBundle\OneupFlysystemBundle(),
            new JMS\TranslationBundle\JMSTranslationBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Bazinga\Bundle\JsTranslationBundle\BazingaJsTranslationBundle(),
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            new WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),
            // eZ Systems
            new EzSystems\PlatformHttpCacheBundle\EzSystemsPlatformHttpCacheBundle(),
            new eZ\Bundle\EzPublishCoreBundle\EzPublishCoreBundle(),
            new eZ\Bundle\EzPublishLegacySearchEngineBundle\EzPublishLegacySearchEngineBundle(),
            new eZ\Bundle\EzPublishIOBundle\EzPublishIOBundle(),
            new eZ\Bundle\EzPublishRestBundle\EzPublishRestBundle(),
            new EzSystems\EzSupportToolsBundle\EzSystemsEzSupportToolsBundle(),
            new EzSystems\PlatformInstallerBundle\EzSystemsPlatformInstallerBundle(),
            new EzSystems\RepositoryFormsBundle\EzSystemsRepositoryFormsBundle(),
            new EzSystems\EzPlatformSolrSearchEngineBundle\EzSystemsEzPlatformSolrSearchEngineBundle(),
            new EzSystems\EzPlatformDesignEngineBundle\EzPlatformDesignEngineBundle(),
            new EzSystems\EzPlatformAdminUiBundle\EzPlatformAdminUiBundle(),
            new EzSystems\EzPlatformAdminUiModulesBundle\EzPlatformAdminUiModulesBundle(),
            new EzSystems\EzPlatformAdminUiAssetsBundle\EzPlatformAdminUiAssetsBundle(),

            // Sylius bundles, part 2

            new Sonata\CoreBundle\SonataCoreBundle(),
            new Sonata\BlockBundle\SonataBlockBundle(),
            new Sonata\IntlBundle\SonataIntlBundle(),
            new Bazinga\Bundle\HateoasBundle\BazingaHateoasBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle(),
            new FOS\RestBundle\FOSRestBundle(),

            new Knp\Bundle\GaufretteBundle\KnpGaufretteBundle(),
            new Payum\Bundle\PayumBundle\PayumBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),

            new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            new Sylius\Bundle\FixturesBundle\SyliusFixturesBundle(),
            new Sylius\Bundle\PayumBundle\SyliusPayumBundle(), // must be added after PayumBundle.
            new Sylius\Bundle\ThemeBundle\SyliusThemeBundle(), // must be added after FrameworkBundle

            // Sylius app bundles

            new Sylius\Bundle\AdminBundle\SyliusAdminBundle(),
            new Sylius\Bundle\ShopBundle\SyliusShopBundle(),

            new FOS\OAuthServerBundle\FOSOAuthServerBundle(), // Required by SyliusAdminApiBundle.
            new Sylius\Bundle\AdminApiBundle\SyliusAdminApiBundle(),

            // eZ + Sylius integration bundle
            new Netgen\Bundle\EzSyliusBundle\NetgenEzSyliusBundle(),

            // Application
            new AppBundle\AppBundle(),
        ];

        switch ($this->getEnvironment()) {
            case 'test':
            case 'behat':
                $bundles[] = new EzSystems\BehatBundle\EzSystemsBehatBundle();
                $bundles[] = new EzSystems\PlatformBehatBundle\EzPlatformBehatBundle();
            // No break, test also needs dev bundles
            case 'dev':
                $bundles[] = new eZ\Bundle\EzPublishDebugBundle\EzPublishDebugBundle();
                $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
                $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
                $bundles[] = new Symfony\Bundle\WebServerBundle\WebServerBundle();
                $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
                $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    protected function getContainerLoader(ContainerInterface $container)
    {
        $locator = new FileLocator($this, $this->getRootDir() . '/Resources');
        $resolver = new LoaderResolver([
            new XmlFileLoader($container, $locator),
            new YamlFileLoader($container, $locator),
            new IniFileLoader($container, $locator),
            new PhpFileLoader($container, $locator),
            new DirectoryLoader($container, $locator),
            new ClosureLoader($container),
        ]);

        return new DelegatingLoader($resolver);
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        if (!empty($_SERVER['SYMFONY_TMP_DIR'])) {
            return rtrim($_SERVER['SYMFONY_TMP_DIR'], '/') . '/var/cache/' . $this->getEnvironment();
        }

        return dirname(__DIR__) . '/var/cache/' . $this->getEnvironment();
    }

    public function getLogDir()
    {
        if (!empty($_SERVER['SYMFONY_TMP_DIR'])) {
            return rtrim($_SERVER['SYMFONY_TMP_DIR'], '/') . '/var/logs';
        }

        return dirname(__DIR__) . '/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir() . '/config/config_' . $this->getEnvironment() . '.yml');
    }
}
