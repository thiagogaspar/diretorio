<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class RichContentSeeder extends Seeder
{
    public function run(): void
    {
        Post::firstOrCreate(
            ['slug' => 'anatomy-supergroup'],
            [
                'title' => 'The Anatomy of a Supergroup: When Legends Collide',
                'excerpt' => 'What happens when members of iconic bands join forces? A deep dive into the supergroup phenomenon from Audioslave to Them Crooked Vultures.',
                'body' => $this->supergroupPost(),
                'author' => 'DIRETÓRIO',
                'is_published' => true,
                'published_at' => now()->subHours(6),
            ]
        );

        Post::firstOrCreate(
            ['slug' => 'basement-to-stadium-grunge'],
            [
                'title' => 'From Basement to Stadium: The Grunge Blueprint',
                'excerpt' => 'How four bands from Seattle\'s underground scene built the template for alternative rock\'s mainstream breakthrough.',
                'body' => $this->grungePost(),
                'author' => 'DIRETÓRIO',
                'is_published' => true,
                'published_at' => now()->subHours(3),
            ]
        );

        Post::firstOrCreate(
            ['slug' => 'art-of-concept-album'],
            [
                'title' => 'The Art of the Concept Album: Stories Set to Music',
                'excerpt' => 'From The Who to Kendrick Lamar, the concept album remains rock\'s most ambitious format for storytelling through music.',
                'body' => $this->conceptAlbumPost(),
                'author' => 'DIRETÓRIO',
                'is_published' => true,
                'published_at' => now()->subHour(),
            ]
        );

        $this->command->info('3 rich blog posts created.');
    }

    private function supergroupPost(): string
    {
        return <<<'HTML'
<div class="prose max-w-none drop-cap">
<p>The supergroup is one of rock music's most fascinating experiments. When established musicians from different successful bands come together, the result can be either transcendent or disappointing. But when it works — as with <strong>Audioslave</strong>, <strong>Temple of the Dog</strong>, and <strong>Them Crooked Vultures</strong> — the music takes on a dimension that none of the member's primary projects could achieve alone.</p>

<h2>The Audioslave Story</h2>

<blockquote class="pull-quote">
<p>"We didn't plan to form a band. We just went into the studio to jam, and three days later we had an album's worth of material."</p>
<cite>Tom Morello, on the formation of Audioslave</cite>
</blockquote>

<p>In 2001, after the hiatus of Rage Against the Machine, guitarist Tom Morello, bassist Tim Commerford, and drummer Brad Wilk found themselves without a frontman. Enter <strong>Chris Cornell</strong>, the legendary voice of Soundgarden, who had just departed from that band. The chemistry was immediate.</p>

<figure class="figure">
<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/Audioslave_2005_%28cropped%29.jpg/800px-Audioslave_2005_%28cropped%29.jpg" alt="Audioslave performing in 2005" width="800" height="450" loading="lazy">
<figcaption>Audioslave at the 2005 tour — Cornell, Morello, Commerford, and Wilk</figcaption>
</figure>

<p>The band's self-titled debut album sold over three million copies, driven by hits like <em>Cochise</em> and <em>Like a Stone</em>. The combination of Cornell's soaring vocals with Morello's innovative guitar work created a sound that was neither Rage nor Soundgarden — it was something entirely new.</p>

<h2>Temple of the Dog: A Tribute That Became a Classic</h2>

<p>Perhaps the most poignant supergroup in rock history, <strong>Temple of the Dog</strong> was formed in 1990 as a tribute to the late Andrew Wood, frontman of Mother Love Bone. The project brought together members of Soundgarden and what would become Pearl Jam, creating a single album that stands as a monument to friendship and grief.</p>

<table>
<thead>
<tr><th>Member</th><th>Primary Band</th><th>Role in Temple</th></tr>
</thead>
<tbody>
<tr><td>Chris Cornell</td><td>Soundgarden</td><td>Vocals, Guitar</td></tr>
<tr><td>Jeff Ament</td><td>Pearl Jam</td><td>Bass</td></tr>
<tr><td>Stone Gossard</td><td>Pearl Jam</td><td>Guitar</td></tr>
<tr><td>Mike McCready</td><td>Pearl Jam</td><td>Lead Guitar</td></tr>
<tr><td>Matt Cameron</td><td>Soundgarden</td><td>Drums</td></tr>
</tbody>
</table>

<p>The album's standout track, <em>Hunger Strike</em>, features a duet between Cornell and a then-unknown Eddie Vedder, marking one of the most iconic vocal collaborations in rock history.</p>

<h2>The Six Degrees of Rock</h2>

<p>What makes supergroups so compelling is how they reveal the interconnected nature of music scenes. Our <a href="/genealogy">genealogy graph</a> visualizes these connections, showing how the Seattle scene alone spawned dozens of interwoven projects across three decades.</p>

<h2>Essential Supergroup Albums</h2>

<ul>
<li><strong>Audioslave</strong> — Audioslave (2002)</li>
<li><strong>Temple of the Dog</strong> — Temple of the Dog (1991)</li>
<li><strong>Them Crooked Vultures</strong> — Them Crooked Vultures (2009)</li>
<li><strong>Traveling Wilburys</strong> — Vol. 1 (1988)</li>
<li><strong>Broken Social Scene</strong> — You Forgot It in People (2002)</li>
</ul>

<h2>Listen to the Supergroup Playlist</h2>

<div class="embed-container">
<iframe src="https://open.spotify.com/embed/playlist/37i9dQZF1DXcBWIGoYBM5M" title="Supergroup playlist" loading="lazy" allowfullscreen></iframe>
</div>
</div>
HTML;
    }

    private function grungePost(): string
    {
        return <<<'HTML'
<div class="prose max-w-none drop-cap">
<p>In 1985, the term "grunge" didn't exist. The bands that would define it were playing in basement venues in Seattle for audiences of fifty people. By 1992, those same bands were selling out arenas worldwide and had fundamentally altered the landscape of popular music.</p>

<h2>The Four Pillars</h2>

<figure class="figure">
<img src="https://upload.wikimedia.org/wikipedia/commons/1/19/Nirvana_around_1992.jpg" alt="Nirvana in 1992" width="800" height="500" loading="lazy">
<figcaption>Nirvana — Kurt Cobain, Krist Novoselic, and Dave Grohl in 1992</figcaption>
</figure>

<table>
<thead>
<tr><th>Band</th><th>Formed</th><th>Debut</th><th>Defining Album</th><th>Sold</th></tr>
</thead>
<tbody>
<tr><td><a href="/bands/nirvana">Nirvana</a></td><td>1987</td><td>Bleach (1989)</td><td>Nevermind (1991)</td><td>75M+</td></tr>
<tr><td><a href="/bands/pearl-jam">Pearl Jam</a></td><td>1990</td><td>Ten (1991)</td><td>Ten (1991)</td><td>85M+</td></tr>
<tr><td><a href="/bands/soundgarden">Soundgarden</a></td><td>1984</td><td>Ultramega OK (1988)</td><td>Superunknown (1994)</td><td>30M+</td></tr>
<tr><td>Alice in Chains</td><td>1987</td><td>Facelift (1990)</td><td>Dirt (1992)</td><td>30M+</td></tr>
</tbody>
</table>

<h2>The Green River Seed</h2>

<p>Before any of these bands existed, there was <strong><a href="/bands/green-river">Green River</a></strong>. Formed in 1985, they are widely considered the first grunge band. Though they released only one EP and one album before disbanding in 1987, their DNA flows through nearly every major grunge act.</p>

<blockquote class="pull-quote">
<p>"Green River was the first band where people went, 'Oh, that's a Seattle sound.' We didn't know what we were starting."</p>
<cite>Mark Arm, Mudhoney (formerly of Green River)</cite>
</blockquote>

<p>Members of Green River went on to form <strong>Mother Love Bone</strong>, which then evolved into <strong>Pearl Jam</strong> after the tragic death of Andrew Wood. Meanwhile, the other members formed <strong>Mudhoney</strong>, who became grunge godfathers in their own right.</p>

<h2>Key Elements of the Grunge Sound</h2>

<ul>
<li><strong>Sludgy guitar riffs</strong> — thick, down-tuned, and fuzzy</li>
<li><strong>Anguished vocals</strong> — from whisper to scream, raw emotion</li>
<li><strong>Dynamic shifts</strong> — quiet verses exploding into loud choruses</li>
<li><strong>Lyrical introspection</strong> — alienation, depression, social critique</li>
<li><strong>Anti-fashion aesthetic</strong> — flannel shirts, ripped jeans, thrift store looks</li>
</ul>

<h2>The Nevermind Earthquake</h2>

<p>When <strong>Nevermind</strong> was released on September 24, 1991, expectations were modest. The album debuted at number 144 on the Billboard 200. But by January 1992, it had knocked Michael Jackson's <em>Dangerous</em> from the number one spot. The first single, <em>Smells Like Teen Spirit</em>, became an anthem for a disaffected generation and launched alternative rock into the mainstream forever.</p>
</div>
HTML;
    }

    private function conceptAlbumPost(): string
    {
        return <<<'HTML'
<div class="prose max-w-none drop-cap">
<p>There is perhaps no format in popular music more ambitious — or more prone to pretense — than the concept album. When it works, it elevates a collection of songs into a cohesive artistic statement that can rival literature or film in emotional impact.</p>

<h2>What Makes an Album a Concept Album?</h2>

<p>A concept album is defined by its unity: a central theme, narrative thread, or musical motif that runs through all or most of its tracks. This can take many forms:</p>

<ul>
<li><strong>Narrative</strong> — tells a story from start to finish (The Who's <em>Tommy</em>)</li>
<li><strong>Thematic</strong> — explores a single subject from multiple angles (Pink Floyd's <em>The Dark Side of the Moon</em>)</li>
<li><strong>Character-driven</strong> — follows a protagonist through transformation (David Bowie's <em>The Rise and Fall of Ziggy Stardust</em>)</li>
</ul>

<h2>The 90s Renaissance</h2>

<p>The 1990s saw a remarkable resurgence of the concept album, particularly in alternative and progressive rock.</p>

<table>
<thead>
<tr><th>Album</th><th>Artist</th><th>Year</th><th>Concept</th></tr>
</thead>
<tbody>
<tr><td>The Wall</td><td>Pink Floyd</td><td>1979</td><td>Isolation and psychological breakdown</td></tr>
<tr><td>American Idiot</td><td>Green Day</td><td>2004</td><td>Disillusionment in post-9/11 America</td></tr>
<tr><td>To Pimp a Butterfly</td><td>Kendrick Lamar</td><td>2015</td><td>Race, fame, and self-actualization</td></tr>
<tr><td>In Utero</td><td><a href="/bands/nirvana">Nirvana</a></td><td>1993</td><td>Pregnancy, illness, and Kurt Cobain's struggles</td></tr>
</tbody>
</table>

<blockquote class="pull-quote">
<p>"I wanted to make an album that felt like a novel you could listen to. Each song is a chapter, but they only make sense together."</p>
<cite>Thom Yorke, on Radiohead's OK Computer</cite>
</blockquote>

<h2>Explore Related Albums</h2>

<p>Browse our <a href="/albums">albums directory</a> to discover concept albums across genres, or check out the discography of bands like <a href="/bands/nirvana">Nirvana</a> and <a href="/bands/pearl-jam">Pearl Jam</a> to hear how they approached the album format.</p>
</div>
HTML;
    }
}
