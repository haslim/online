<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Tema varsayılan Customizer değerlerini ve metinlerini döndürür.
 * Çoklu dil (Polylang/Loco Translate) uyumlu olması için text domain'i ile tanımlanır.
 *
 * @param string $key Ayarın anahtarı.
 * @return mixed Varsayılan değer veya boş string.
 */
function bga_get_default( $key ) {
    $defaults = [
        // Hero Bölümü
        'hero_title' => __('AV. Arb. Billur GÜLER ASLIM', 'billur-guler-aslim'),
        'hero_tagline' => __('Hukuki Çözümlerde Güvenilir Ortağınız <br> Karmaşık süreçlerde netlik, stratejik davalarda güç.', 'billur-guler-aslim'),
        
        // Hakkımda Bölümü
        'about_subheading_1' => __('Felsefem', 'billur-guler-aslim'),
        'about_text_1' => __('Hukuk, yalnızca kanun metinlerinden ibaret değildir; temelinde insan, adalet ve denge arayışı yatar. Benimsediğim yaklaşım, müvekkillerimin hukuki ihtiyaçlarını derinlemesine anlamak ve bu ihtiyaçları sadece yasal çerçevede değil, aynı zamanda stratejik ve ticari hedefleri doğrultusunda çözüme kavuşturmaktır.', 'billur-guler-aslim'),
        'about_subheading_2' => __('Biyografi', 'billur-guler-aslim'),
        'about_text_2' => __('15 yılı aşkın mesleki tecrübemle, Antalya merkezli olarak avukatlık, arabuluculuk ve marka-patent vekilliği alanlarında hizmet vermekteyim. Fikri Mülkiyet Hukuku, İş Hukuku, Ticaret Hukuku ve Tüketici Hukuku gibi alanlardaki uzmanlığımı, uyuşmazlıkların çözümünde modern ve sonuç odaklı bir bakış açısıyla birleştiriyorum.', 'billur-guler-aslim'),
        
        // Uzmanlık Alanları Bölümü (Services)
        'services_title' => __('Uzmanlık Alanları', 'billur-guler-aslim'),
        'services_subtitle' => __('Hukuki sorunlarınıza, bütüncül bir bakış açısıyla yaklaşıyor; dava takibi, danışmanlık ve alternatif çözüm yolları ile kapsamlı hizmet sunuyorum.', 'billur-guler-aslim'),
        'service_title_1' => __('Hukuki Danışmanlık ve Dava Takibi', 'billur-guler-aslim'),
        'service_content_1' => __('Ticaret Hukuku, İş Hukuku, Fikri Mülkiyet, Bankacılık ve Finans gibi alanlarda önleyici hukuk hizmetleri ve stratejik dava takibi. Müvekkillerimin haklarını korumak ve ticari hedeflerine ulaşmalarını sağlamak için titiz bir çalışma yürütürüm.', 'billur-guler-aslim'),
        'service_icon_1' => 'law-book',
        'service_title_2' => __('Arabuluculuk Hizmetleri', 'billur-guler-aslim'),
        'service_content_2' => __('Ticari, iş, tüketici ve fikri mülkiyet uyuşmazlıklarında uzman arabulucu olarak, tarafların mahkeme süreçlerinin getirdiği zaman ve maliyet yükünden kurtularak, kendi çözümlerini kendilerinin üretmesine yardımcı olurum. Gizlilik ve tarafsızlık esastır.', 'billur-guler-aslim'),
        'service_icon_2' => 'court',
        'service_title_3' => __('Marka & Patent Vekilliği', 'billur-guler-aslim'),
        'service_content_3' => __('Fikri ve sınai haklarınız, en değerli varlıklarınızdır. Marka tescili, patent ve tasarım başvuruları, lisans sözleşmeleri ve hak ihlallerine karşı koruma gibi konularda, sürecin başından sonuna kadar profesyonel vekillik hizmeti sunarım.', 'billur-guler-aslim'),
        'service_icon_3' => 'judge',
        
        // Yetkinlikler Bölümü (Credentials)
        'credentials_title' => __('Yetkinlikler & Sertifikalar', 'billur-guler-aslim'),
        'credentials_subtitle' => __('Mesleki gelişimime olan bağlılığım, müvekkillerime her zaman en güncel ve nitelikli hizmeti sunmamı sağlar.', 'billur-guler-aslim'),
        'credential_main_icon' => 'certificate', // Tüm yetkinlik kartları için varsayılan ikon
        'credential_title_1' => __('Fikri Mülkiyet Hukuku Arabuluculuk Uzmanlık Eğitimi', 'billur-guler-aslim'),
        'credential_issuer_1' => __('Antalya Bilim Üniversitesi', 'billur-guler-aslim'),
        'credential_title_2' => __('İş Mevzuatından Kaynaklı Nitelikli Hesaplamalar Bilirkişilik Eğitimi', 'billur-guler-aslim'),
        'credential_issuer_2' => __('Bilgi Birikim Danışmanlık A.Ş.', 'billur-guler-aslim'),
        'credential_title_3' => __('Banka ve Finans Hukukunda Arabuluculuk Uzmanlık Eğitimi', 'billur-guler-aslim'),
        'credential_issuer_3' => __('Ankara Üniversitesi', 'billur-guler-aslim'),
        'credential_title_4' => __('Tahkimde Taraf Vekilliği Eğitimi', 'billur-guler-aslim'),
        'credential_issuer_4' => __('Türkiye Barolar Birliği', 'billur-guler-aslim'),
        'credential_title_5' => __('Ticaret Hukuku Genel Uzmanlık Alanı Arabuluculuk Eğitimi', 'billur-guler-aslim'),
        'credential_issuer_5' => __('Sakarya Üniversitesi', 'billur-guler-aslim'),
        'credential_title_6' => __('Bilirkişilik Temel Eğitimi', 'billur-guler-aslim'),
        'credential_issuer_6' => __('Başkent Üniversitesi', 'billur-guler-aslim'),
        
        // İletişim Bölümü
        'contact_title' => __('İletişim', 'billur-guler-aslim'),
        'contact_subtitle' => __('Hukuki bir konuda görüşmek veya randevu almak için aşağıdaki bilgileri kullanabilirsiniz.', 'billur-guler-aslim'),
        'contact_address' => __('ADRES<br>Muratpaşa, Antalya, Türkiye', 'billur-guler-aslim'),
        'contact_email' => 'bilgi@billurguleraslim.av.tr',
        'contact_phone' => '+90 549 454 76 76',
        'contact_linkedin' => 'https://www.linkedin.com/in/billur-güler-aslim-64522b205/',
        'contact_form_shortcode' => '[contact-form-7 id="xxxxxxxx" title="İletişim Formu"]', // Contact Form 7 shortcode example
        
        // Footer Bölümü
        'footer_copyright' => __('© [year] AV. Arb. Billur GÜLER ASLIM. Tüm hakları saklıdır.', 'billur-guler-aslim'),
        'whatsapp_number' => '905494547676', // WhatsApp numarası (sadece rakamlar)

        // GDPR Bölümü
        'gdpr_notice_text' => __('Bu site çerezler kullanmaktadır. Hizmet kalitemizi artırmak için çerez kullanımına izin veriyor musunuz? <a href="%s" class="gdpr-link">Daha fazla bilgi edinin</a>', 'billur-guler-aslim'),
        'gdpr_button_text' => __('Kabul Ediyorum', 'billur-guler-aslim'),
    ];

    return $defaults[$key] ?? '';
}