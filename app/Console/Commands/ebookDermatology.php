<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Ebook;
use App\Video;
use Storage;

class ebookDermatology extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:ebook';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
		$videos = [
			'Pelatihan Ipl Cellec-1.m4v',
			'Pelatihan Rf-1.m4v',
			'Rf-1.m4v',
			'Threadlift 1-1.m4v',
			'Threadlift 2-1.m4v',
			'video pelatihan laser.mp4'
		];
		$ebooks = [
			"1. MMWR std 2015.pdf",
			"10. Rapini Practical Dermatopathology, 2nd ed. - 2012, Ronald P.Rapini (TEXTBOOK PA UTAMA).pdf",
			"11. PPK PERDOSKI 2017.pdf",
			"12. Surgery of the skin Robinson ed 3 2015.pdf",
			"13. Laser and lights ed 3 2013.pdf",
			"14. Pedoman tatalaksana sifilis 2013.pdf",
			"15. Filler Maio ed 2 2014.pdf",
			"16. Rook's Textbook of Dermatology. ed 9 Christopher Griffiths, et al-Wiley-Blackwell 2016.pdf",
			"17. Formula ingredient cosmetic Shimada Japan 2013.pdf",
			"19. Cosmeceuticals&cosmetic practice Farris 2014.pdf",
			"2. Cosmetic dermatology Draelos ed 2 2016.pdf",
			"20. Dermatology flashcard fitz 2014.pdf",
			"21. Clinical dermatology Habif 2016.pdf",
			"23. Clinical dermatology ed 5 weller 2015.pdf",
			"27. Dermatology at a glance 2013.pdf",
			"28. Color atlas fitz edisi 7 2013.pdf",
			"29. Pediatric dermatology mallory 2005.pdf",
			"3. Leprosy sehgal 2006.pdf",
			"30. Dermoscopy bowling 2012.pdf",
			"31. The art of skin health obagi 2015.pdf",
			"32. Dermatology pictorial review 2010.pdf",
			"33. Andrew Disease of Skin Ed 12 2016.pdf",
			"37. Acne danby 2015.pdf",
			"38. Comprehensif dermatology drug therapy ed3.pdf",
			"4. World clinics dermatology acne Khanna 2014.pdf",
			"40. Surgical atlas perforator flap 2015.pdf",
			"42. Textbook cosmetic dermatology ed 4 2010.pdf",
			"44. Dermatology ed 3-Bolognia 2012.pdf",
			"46. Color atlas STD 2011.pdf",
			"47. The_Alopecias_Diagnosis_and_Treatments-Bouhanna 2016.pdf",
			"49. Basic imunologi abbas 2016.pdf",
			"50. Color atlas dermatology 2012.pdf",
			"53. Clinical_Handbook_of_Contact_Dermatitis 2015.pdf",
			"54. Harper's Textbook of Pediatric Dermatology (3rd Ed.)  2011.pdf",
			"56. Lever's Histophatology Skin Lever ed 3-2013.pdf",
			"58. Treatment of Skin Disease 4th Edition ed4 2014.pdf",
			"6. Hiv essentials ed 7 2014.pdf",
			"63. Clinical_Cases_in_Skin_of_Color 2016.pdf",
			"64. Weedons_Skin Pathology Essentials ed 2-2017.pdf",
			"66. PanduanLayanan Integrasi IMS 2015.pdf",
			"67. Pedoman Nasional Penanganan IMS_2015_LENGKAP_Nov2015.pdf",
			"68. Dermatological_Signs_of_Systemic ed 4 2017.pdf",
			"7. Cosmetic dermatology skin color Alam 2009.pdf",
			"70. Holmes STD (TEXTBOOK IMS UTAMA) ed 4 2008.pdf",
			"8. dermatologic cosmeceutic&cosmetic development 2008.pdf",
			"ABC Dermatology - Paul Buxton ed 5 2009.pdf",
			"Acne and rosacea Goldberg 2012.pdf",
			"Advanced tehnique dermatology surgery 2006.pdf",
			"Anatomy plastic surgery Watanabe 2016.pdf",
			"Anestesi analgesi bedah dermatologi 2008 Marwali Harahap.pdf",
			"Atlas cosmetic surgery edisi 2 Kaminer.pdf",
			"Atlas of Dermatology in Internal Medicine 2012.pdf",
			"Atlas of Mesotherapy 2007.pdf",
			"Atlas of pathogenic fungi.pdf",
			"Atlas suturing tehnique 2016.pdf",
			"Baker Flap ed 3 2014.pdf",
			"Bouhanna alopecias 2016.pdf",
			"Buka emergency dermatology 2013.pdf",
			"BukuPedomanPraktisIMS_2016_final_22Nov2015.pdf",
			"Chemical technologi cosmetic 2013.pdf",
			"Cohen Pediatric Dermatology ed4 2013.pdf",
			"Cosmetic Dermatology - C. Burgess (ed.) (Springer, 2005) WW.pdf",
			"Cosmetic dermatology surgery 2008.pdf",
			"Cosmetic Injection Techniques A Text and Video Guide to Neurotoxins and Fillers 2013.pdf",
			"Cutaneus cryotherapy edisi 4 2005.pdf",
			"Dermatologi for advanced ed1 2015.pdf",
			"Dermatologi secret plus ed 4 fitz 2011.pdf",
			"Dermatology advanced practice - Bobonich - ed 5 2015.pdf",
			"Dermatology drug therapy.pdf",
			"Emergency Dermatology 2010.pdf",
			"Emergency_Dermatology wolf and paris - ed2 2017.pdf",
			"Evidence_Based_Dermatology 2008.pdf",
			"Fitzpatrick's Color Atlas And Synopsis Of Clinical Dermatology, 8th Edition.pdf",
			"Fitzpatricks Dermatology in General Med, 8Ed, 2012, Lowell A. Goldsmith mode asli (TEXTBOOK UTAMA).pdf",
			"Goodheart's Photoguide to Common Skin Disorders_ Diagnosis and Management-Herbert P. Goodheart MD-LWW (2008).pdf",
			"Handbook laser dermatology Nouri 2014.pdf",
			"Hurwitz Clinical Pediatric Dermatology edisi 4 2011.pdf",
			"IMS UI ed 4.pdf",
			"Lange Clinical Dermatologi ed 1 2013.pdf",
			"Lanzox botulinum toxin A kalbe.pdf",
			"Laser dermatology goldberg 2008.pdf",
			"Laser Procedures Rebecca 2016.pdf",
			"Lasers in Dermatology & Medicine NOURI 2011.pdf",
			"Lasers in dermatology practice 2014.pdf",
			"Lepra e-Translated Bryceson.pdf",
			"Manual dermatology terapeutik ed 8 2014.pdf",
			"McKee's Pathology of Skin-With Clinical Correlations, 4th ed. - 2012, McKee.pdf",
			"Pediatric Dermatology, ed4 2013 - Cohen.pdf",
			"pediatric_dermatology atlas2009.pdf",
			"pediatric_dermatology_2009 color atlas.pdf",
			"Pedoman Nasional Penanganan IMS_2015_LENGKAP_Nov2015.pdf",
			"Phototherapy_and_Photodiagnostic - sheng chong 2017.pdf",
			"Sexual health and genital medicine 2015.pdf",
			"Sexual health genital medicine ed 2 2015.pdf",
			"Sinopsis dermatology and STD ed4 Khanna 2011.pdf",
			"STI and STD 1 2011.pdf",
			"Textbook aging skin 2010.pdf",
			"Textbook chemical peel Deprez 2007.pdf",
			"Textbook cosmetic ed 4 2010-Goldberg.pdf",
			"The_Difficult_Hair_Loss_Patient 2015.pdf",
			"Update cosmetic dermatology 2013.pdf",
			"Vitiligo and hipomelanosis Fitz.pdf",
			"Weedons_Skin_Pathology_Essentials ed 2 2017.pdf"
		];

		$data = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($ebooks as $ebook) {
			$data[] = [
				'judul' => $ebook,
				'link_materi'      => Storage::cloud()->url('ebook/' . $ebook),
				'nama_file_materi' => 'ebook/' . $ebook,
				'created_at'       => $timestamp,
				'updated_at'       => $timestamp
			];
		}
		Ebook::truncate();
		Ebook::insert($data);
		$data = [];
		foreach ($videos as $video) {
			$data[] = [
				'judul' => $video,
				'link_materi'      => Storage::cloud()->url('video/' . $video),
				'nama_file_materi' => 'video/' . $video,
				'created_at'       => $timestamp,
				'updated_at'       => $timestamp
			];
		}
		Video::truncate();
		Video::insert($data);
    }
}
