<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Ekyna\Bundle\RequireJsBundle\EkynaRequireJsBundle(),
            new Ekyna\Bundle\FontAwesomeBundle\EkynaFontAwesomeBundle(),
            new Ekyna\Bundle\DemoBundle\EkynaDemoBundle(),
            new Ekyna\Bundle\NewsBundle\EkynaNewsBundle(),
            new Ekyna\Bundle\SurveyBundle\EkynaSurveyBundle(),
            new Ekyna\Bundle\AgendaBundle\EkynaAgendaBundle(),
            new Ekyna\Bundle\AdvertisementBundle\EkynaAdvertisementBundle(),
            new Ekyna\Bundle\CharacteristicsBundle\EkynaCharacteristicsBundle(),
            //new Ekyna\Bundle\LocalityBundle\EkynaLocalityBundle(),
            new Ekyna\Bundle\SubscriptionBundle\EkynaSubscriptionBundle(),
            new Ekyna\Bundle\CartBundle\EkynaCartBundle(),
            new Ekyna\Bundle\OrderBundle\EkynaOrderBundle(),
            new Ekyna\Bundle\PaymentBundle\EkynaPaymentBundle(),
            new Ekyna\Bundle\ShipmentBundle\EkynaShipmentBundle(),
            new Ekyna\Bundle\ProductBundle\EkynaProductBundle(),
            new Ekyna\Bundle\BlogBundle\EkynaBlogBundle(),
            new Ekyna\Bundle\MailingBundle\EkynaMailingBundle(),
            //new Ekyna\Bundle\ContactBundle\EkynaContactBundle(),
            new Ekyna\Bundle\SocialButtonsBundle\EkynaSocialButtonsBundle(),
            new Ekyna\Bundle\CmsBundle\EkynaCmsBundle(),
            new Ekyna\Bundle\SettingBundle\EkynaSettingBundle(),
            new Ekyna\Bundle\TableBundle\EkynaTableBundle(),
            new Ekyna\Bundle\UserBundle\EkynaUserBundle(),
//            new Ekyna\Bundle\FileManagerBundle\EkynaFileManagerBundle(),
            new Ekyna\Bundle\GoogleBundle\EkynaGoogleBundle(),
            new Ekyna\Bundle\SitemapBundle\EkynaSitemapBundle(),
            new Ekyna\Bundle\InstallBundle\EkynaInstallBundle(),

            new Ekyna\Bundle\MediaBundle\EkynaMediaBundle(),

            new Ekyna\Bundle\AdminBundle\EkynaAdminBundle(),
            new Ekyna\Bundle\CoreBundle\EkynaCoreBundle(),

            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Doctrine\Bundle\DoctrineCacheBundle\DoctrineCacheBundle(),
            new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

            new JMS\SerializerBundle\JMSSerializerBundle(),
//            new JMS\TranslationBundle\JMSTranslationBundle(),
            new JMS\TwigJsBundle\JMSTwigJsBundle(),
            new JMS\I18nRoutingBundle\JMSI18nRoutingBundle(),
            new Liip\ImagineBundle\LiipImagineBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Knp\Bundle\SnappyBundle\KnpSnappyBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            new FOS\ElasticaBundle\FOSElasticaBundle(),
            new FOS\HttpCacheBundle\FOSHttpCacheBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new A2lix\TranslationFormBundle\A2lixTranslationFormBundle(),
            new Stfalcon\Bundle\TinymceBundle\StfalconTinymceBundle(),
            new WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),
            new Braincrafted\Bundle\BootstrapBundle\BraincraftedBootstrapBundle(),
            new Payum\Bundle\PayumBundle\PayumBundle(),
            new winzou\Bundle\StateMachineBundle\winzouStateMachineBundle(),
            new Craue\FormFlowBundle\CraueFormFlowBundle(),
            new Misd\PhoneNumberBundle\MisdPhoneNumberBundle(),
            new Oneup\FlysystemBundle\OneupFlysystemBundle(),
            new Oneup\UploaderBundle\OneupUploaderBundle(),
            new Gregwar\CaptchaBundle\GregwarCaptchaBundle(),
            new Ivory\GoogleMapBundle\IvoryGoogleMapBundle(),
            new Ob\HighchartsBundle\ObHighchartsBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
            $bundles[] = new Hautelook\AliceBundle\HautelookAliceBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
