@extends('layouts.app')

@section('title', 'Berita & Artikel - Go Green School')

@push('styles')
    <style>
        .news-async-loading {
            opacity: .55;
            pointer-events: none;
            transition: opacity .2s ease;
        }

        .news-pagination {
            margin-top: 50px;
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .news-pagination .page-link {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1px solid #ddd;
            background: #fff;
            color: var(--dark);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-weight: 600;
        }

        .news-pagination .page-link.active {
            border-color: var(--primary);
            background: var(--primary);
            color: #fff;
        }

        .news-pagination .page-link.disabled {
            opacity: .45;
            pointer-events: none;
        }

        .news-tag-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #f4f7f5;
            color: #4b5a52;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: .82rem;
            text-decoration: none;
            border: 1px solid rgba(46, 125, 50, 0.08);
        }

        .news-tag-chip.active {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        .active-filters-wrap {
            margin-top: 14px;
            padding-top: 14px;
            border-top: 1px dashed #dbe6de;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
        }

        .active-filter-label {
            font-size: .83rem;
            color: #5e6f65;
            font-weight: 600;
            margin-right: 2px;
        }

        .active-filter-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #eaf4ed;
            color: #2d5f3e;
            border: 1px solid rgba(46, 125, 50, .16);
            border-radius: 999px;
            padding: 5px 10px;
            font-size: .8rem;
            text-decoration: none;
        }

        .active-filter-remove {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(46, 125, 50, .14);
            color: #1f4f31;
            font-size: .72rem;
        }

        .active-filter-clear {
            background: transparent;
            color: #7d8f84;
            font-size: .8rem;
            text-decoration: none;
            border-bottom: 1px dashed #a0b2a7;
            line-height: 1.1;
        }

        .news-modal {
            position: fixed;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            z-index: 3000;
            background: rgba(0, 0, 0, .55);
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition: opacity .28s ease, visibility .28s ease;
        }

        .news-modal.open {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }

        .news-modal-dialog {
            width: min(860px, 100%);
            max-height: 92vh;
            overflow: auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, .28);
            opacity: 0;
            transform: translateY(20px) scale(.98);
            transition: opacity .28s ease, transform .28s ease;
            will-change: opacity, transform;
        }

        .news-modal.open .news-modal-dialog {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .news-modal-cover {
            width: 100%;
            height: 280px;
            object-fit: cover;
            display: block;
        }

        .news-modal-body {
            padding: 24px;
        }

        .news-modal-close {
            border: none;
            background: #f2f5f3;
            color: #2f3a33;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            cursor: pointer;
        }

        .news-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(46, 125, 50, 0.1) !important;
        }
    </style>
@endpush

@section('content')
    @php
        $selectedTags = $selectedTags ?? [];
        $selectedTagsParam = implode(',', $selectedTags);
        $featuredPool = $featuredPool ?? [];
    @endphp

    <section class="page-hero"
        style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1497250681960-ef046c08a56e?auto=format&fit=crop&w=1800&q=80'); background-size: cover; background-position: center; background-attachment: fixed; position: relative;">
        <div class="page-hero-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        <div class="page-hero-particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>
        <canvas class="leaves-canvas" id="leavesCanvas"></canvas>
        <div class="page-hero-content" style="position: relative; z-index: 10; color: white; text-align: center;">
            <div class="container">
                <div class="page-hero-icon"
                    style="background: rgba(255,255,255,0.2); backdrop-filter: blur(5px); color: #fff; width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; margin: 0 auto 20px;">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div class="page-hero-badge"
                    style="background: rgba(76, 175, 80, 0.8); color: white; border: none; padding: 8px 20px; font-weight: bold; border-radius: 30px; display: inline-block; margin-bottom: 20px;">
                    <i class="fas fa-circle" style="color: #c8e6c9;"></i> Update Terbaru
                </div>
                <h1 style="color: white; font-size: 3.5rem; font-weight: 800; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                    Berita <span class="highlight" style="color: #a5d6a7; text-shadow: none;">Artikel</span> Lingkungan
                </h1>
                <div class="page-hero-decor-line" style="background: #a5d6a7; height: 4px; width: 60px; margin: 20px auto;">
                </div>
                <p class="page-hero-desc"
                    style="color: #e0e0e0; font-size: 1.2rem; max-width: 600px; margin: 0 auto 30px; text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">
                    Dapatkan pembaruan terbaru seputar kegiatan, prestasi, serta artikel edukatif mengenai pelestarian
                    lingkungan di sekolah kami.
                </p>
                <div class="page-hero-breadcrumb"
                    style="background: rgba(0,0,0,0.4); padding: 10px 20px; border-radius: 20px; display: inline-flex; gap: 10px;">
                    <a href="{{ route('home') }}" style="color: #a5d6a7; text-decoration: none;"><i class="fas fa-home"></i>
                        Beranda</a>
                    <span class="separator" style="color: #999;"><i class="fas fa-chevron-right"></i></span>
                    <span class="current" style="color: white;">Berita</span>
                </div>
            </div>
        </div>
    </section>

    <section class="news-page-section" style="padding: 60px 0; background: #f9fcfa;">
        <div class="container">

            <div class="row" id="newsInteractiveContent" style="display: flex; flex-wrap: wrap; gap: 40px;">

                {{-- Main Column --}}
                <div class="main-column" style="flex: 1 1 65%;">

                    @if ($featuredArticle)
                        {{-- Featured Big News (bergiliran dari data berita) --}}
                        <div class="news-card big-news" id="featuredNewsCard"
                            data-featured-id="{{ $featuredArticle['id'] }}"
                            style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); margin-bottom: 40px;">
                            <img src="{{ $featuredArticle['image'] }}" alt="{{ $featuredArticle['title'] }}"
                                id="featuredNewsImage" style="width: 100%; height: 350px; object-fit: cover;">
                            <div style="padding: 30px;">
                                <div
                                    style="display:flex; gap:15px; margin-bottom: 15px; font-size: 0.9rem; color: var(--gray); flex-wrap: wrap;">
                                    <span><i class="far fa-calendar text-primary"></i> <span
                                            id="featuredNewsDate">{{ $featuredArticle['date'] }}</span></span>
                                    <span><i class="far fa-user text-primary"></i> <span
                                            id="featuredNewsAuthor">{{ $featuredArticle['author'] }}</span></span>
                                    <span id="featuredNewsCategory"
                                        style="background:var(--accent); color:white; padding: 2px 10px; border-radius:10px; font-size:0.8rem;">{{ $featuredArticle['category'] }}</span>
                                </div>
                                <h2 id="featuredNewsTitle"
                                    style="margin-bottom: 15px; font-size: 1.8rem; color: var(--dark);">
                                    {{ $featuredArticle['title'] }}</h2>
                                <p id="featuredNewsExcerpt"
                                    style="color: var(--gray); line-height: 1.7; margin-bottom: 15px;">
                                    {{ $featuredArticle['excerpt'] }}</p>
                                <div id="featuredNewsTags"
                                    style="display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 22px;">
                                    @foreach ($featuredArticle['tags'] as $tag)
                                        <span class="news-tag-chip">#{{ $tag }}</span>
                                    @endforeach
                                </div>
                                <button type="button" class="btn-primary open-news-modal" id="featuredNewsReadMore"
                                    style="padding: 8px 20px;" data-title="{{ $featuredArticle['title'] }}"
                                    data-date="{{ $featuredArticle['date'] }}"
                                    data-author="{{ $featuredArticle['author'] }}"
                                    data-category="{{ $featuredArticle['category'] }}"
                                    data-image="{{ $featuredArticle['image'] }}"
                                    data-tags="{{ implode(', ', $featuredArticle['tags']) }}"
                                    data-full="{{ $featuredArticle['full_description'] }}">Baca Selengkapnya</button>
                            </div>
                        </div>
                        <script type="application/json" id="featuredPoolData">@json($featuredPool)</script>
                    @endif

                    {{-- Other News Grid --}}
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
                        @forelse ($paginatedArticles as $article)
                            <div class="news-card"
                                style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.03);">
                                <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}"
                                    style="width:100%; height: 200px; object-fit: cover;">
                                <div style="padding: 20px;">
                                    <span
                                        style="color: var(--gray); font-size: 0.85rem; display: block; margin-bottom: 10px;"><i
                                            class="far fa-clock"></i> {{ $article['date'] }}</span>
                                    <h3
                                        style="font-size: 1.2rem; margin-bottom: 10px; color: var(--dark); line-height: 1.4;">
                                        {{ $article['title'] }}</h3>
                                    <p
                                        style="color: var(--gray); font-size: .95rem; margin-bottom: 14px; line-height: 1.6;">
                                        {{ $article['excerpt'] }}
                                    </p>
                                    <div style="display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 14px;">
                                        @foreach ($article['tags'] as $tag)
                                            <span class="news-tag-chip">#{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                    <button type="button" class="open-news-modal"
                                        style="color: var(--primary); font-weight: 600; text-decoration: none; border:none; background:none; padding:0; cursor:pointer;"
                                        data-title="{{ $article['title'] }}" data-date="{{ $article['date'] }}"
                                        data-author="{{ $article['author'] }}"
                                        data-category="{{ $article['category'] }}" data-image="{{ $article['image'] }}"
                                        data-tags="{{ implode(', ', $article['tags']) }}"
                                        data-full="{{ $article['full_description'] }}">Baca Selengkapnya &rarr;</button>
                                </div>
                            </div>
                        @empty
                            <div
                                style="grid-column: 1 / -1; background: #fff; border-radius: 14px; border: 1px dashed #d7e3da; padding: 24px; color: #55655c;">
                                Belum ada berita yang cocok dengan filter saat ini.
                            </div>
                        @endforelse
                    </div>

                    {{-- Pagination --}}
                    @if ($paginatedArticles->lastPage() > 1)
                        <div class="news-pagination">
                            <a href="{{ $paginatedArticles->previousPageUrl() ?? '#' }}"
                                class="page-link {{ $paginatedArticles->onFirstPage() ? 'disabled' : '' }}"
                                data-news-ajax-link aria-label="Halaman sebelumnya"><i
                                    class="fas fa-chevron-left"></i></a>

                            @for ($page = 1; $page <= $paginatedArticles->lastPage(); $page++)
                                <a href="{{ $paginatedArticles->url($page) }}" data-news-ajax-link
                                    class="page-link {{ $paginatedArticles->currentPage() === $page ? 'active' : '' }}">{{ $page }}</a>
                            @endfor

                            <a href="{{ $paginatedArticles->nextPageUrl() ?? '#' }}"
                                class="page-link {{ $paginatedArticles->hasMorePages() ? '' : 'disabled' }}"
                                data-news-ajax-link aria-label="Halaman berikutnya"><i
                                    class="fas fa-chevron-right"></i></a>
                        </div>
                    @endif

                </div>

                {{-- Sidebar --}}
                <div class="sidebar-column" style="flex: 1 1 30%; max-width: 350px;">

                    {{-- Search --}}
                    <div class="news-sidebar-card"
                        style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.03); margin-bottom: 30px;">
                        <h4 style="margin-bottom: 15px; border-left: 3px solid var(--primary); padding-left: 10px;">Cari
                            Berita</h4>
                        <form method="GET" action="{{ route('news') }}" style="display:flex;" data-news-ajax-form>
                            @if ($selectedTagsParam !== '')
                                <input type="hidden" name="tags" value="{{ $selectedTagsParam }}">
                            @endif
                            <input type="text" name="q" value="{{ $search }}"
                                placeholder="Kata kunci..."
                                style="width: 100%; padding: 10px 15px; border: 1px solid #ddd; border-radius: 5px 0 0 5px; outline:none;">
                            <button type="submit"
                                style="background: var(--primary); color: white; border: none; padding: 0 15px; border-radius: 0 5px 5px 0; cursor:pointer;"><i
                                    class="fas fa-search"></i></button>
                        </form>

                        @if ($search !== '' || $selectedTags !== [])
                            <div class="active-filters-wrap">
                                <span class="active-filter-label">Filter aktif:</span>

                                @if ($search !== '')
                                    <a href="{{ route('news', array_filter(['tags' => $selectedTagsParam !== '' ? $selectedTagsParam : null])) }}"
                                        class="active-filter-chip" data-news-ajax-link>
                                        Cari: "{{ $search }}"
                                        <span class="active-filter-remove"><i class="fas fa-times"></i></span>
                                    </a>
                                @endif

                                @foreach ($selectedTags as $activeTag)
                                    @php
                                        $remainingTags = array_values(
                                            array_filter(
                                                $selectedTags,
                                                static fn(string $tag): bool => strtolower($tag) !==
                                                    strtolower($activeTag),
                                            ),
                                        );
                                        $remainingTagsParam = implode(',', $remainingTags);
                                    @endphp
                                    <a href="{{ route('news', array_filter(['tags' => $remainingTagsParam !== '' ? $remainingTagsParam : null, 'q' => $search !== '' ? $search : null])) }}"
                                        class="active-filter-chip" data-news-ajax-link>
                                        #{{ $activeTag }}
                                        <span class="active-filter-remove"><i class="fas fa-times"></i></span>
                                    </a>
                                @endforeach

                                <a href="{{ route('news') }}" class="active-filter-clear" data-news-ajax-link>Reset
                                    semua</a>
                            </div>
                        @endif
                    </div>

                    {{-- Filter Tag --}}
                    <div class="news-sidebar-card"
                        style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.03); margin-bottom: 30px;">
                        <h4 style="margin-bottom: 15px; border-left: 3px solid var(--primary); padding-left: 10px;">Filter
                            Tag</h4>
                        <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                            <a href="{{ route('news', array_filter(['q' => $search !== '' ? $search : null])) }}"
                                data-news-ajax-link
                                class="news-tag-chip {{ $selectedTags === [] ? 'active' : '' }}">Semua</a>
                            @foreach ($tagCounts as $tag => $count)
                                @php
                                    $hasTag = in_array(strtolower($tag), array_map('strtolower', $selectedTags), true);
                                    $nextTags = $selectedTags;

                                    if ($hasTag) {
                                        $nextTags = array_values(
                                            array_filter(
                                                $selectedTags,
                                                static fn(string $selected): bool => strtolower($selected) !==
                                                    strtolower($tag),
                                            ),
                                        );
                                    } else {
                                        $nextTags[] = $tag;
                                    }

                                    $nextTagsParam = implode(',', $nextTags);
                                @endphp
                                <a href="{{ route('news', array_filter(['tags' => $nextTagsParam !== '' ? $nextTagsParam : null, 'q' => $search !== '' ? $search : null])) }}"
                                    data-news-ajax-link
                                    class="news-tag-chip {{ $hasTag ? 'active' : '' }}">#{{ $tag }}
                                    ({{ $count }})
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- Popular Tags --}}
                    <div class="news-sidebar-card"
                        style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.03);">
                        <h4 style="margin-bottom: 15px; border-left: 3px solid var(--primary); padding-left: 10px;">Tag
                            Populer</h4>
                        <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                            @foreach (array_slice(array_keys($tagCounts), 0, 8) as $popularTag)
                                @php
                                    $popularActive = in_array(
                                        strtolower($popularTag),
                                        array_map('strtolower', $selectedTags),
                                        true,
                                    );
                                    $popularNextTags = $selectedTags;

                                    if ($popularActive) {
                                        $popularNextTags = array_values(
                                            array_filter(
                                                $selectedTags,
                                                static fn(string $selected): bool => strtolower($selected) !==
                                                    strtolower($popularTag),
                                            ),
                                        );
                                    } else {
                                        $popularNextTags[] = $popularTag;
                                    }

                                    $popularNextTagsParam = implode(',', $popularNextTags);
                                @endphp
                                <a href="{{ route('news', array_filter(['tags' => $popularNextTagsParam !== '' ? $popularNextTagsParam : null, 'q' => $search !== '' ? $search : null])) }}"
                                    data-news-ajax-link
                                    class="news-tag-chip {{ $popularActive ? 'active' : '' }}">#{{ $popularTag }}</a>
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>

    {{-- News Detail Modal --}}
    <div class="news-modal" id="newsModal" aria-hidden="true">
        <div class="news-modal-dialog" role="dialog" aria-modal="true" aria-labelledby="newsModalTitle">
            <img src="" alt="Detail Berita" id="newsModalImage" class="news-modal-cover">
            <div class="news-modal-body">
                <div
                    style="display:flex; justify-content: space-between; gap: 14px; align-items: start; margin-bottom: 14px;">
                    <div>
                        <h3 id="newsModalTitle" style="font-size: 1.6rem; color: var(--dark); margin-bottom: 8px;"></h3>
                        <p style="color: #6b7d72; font-size: .95rem; margin: 0;">
                            <span id="newsModalDate"></span> • <span id="newsModalAuthor"></span> •
                            <strong id="newsModalCategory" style="color: var(--primary);"></strong>
                        </p>
                    </div>
                    <button type="button" class="news-modal-close" id="newsModalClose"
                        aria-label="Tutup detail berita">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div id="newsModalTags" style="display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 14px;"></div>
                <p id="newsModalDescription" style="color: #415249; line-height: 1.8; white-space: pre-line;"></p>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (function() {
            const interactiveSelector = '#newsInteractiveContent';
            const modal = document.getElementById('newsModal');
            const modalTitle = document.getElementById('newsModalTitle');
            const modalDate = document.getElementById('newsModalDate');
            const modalAuthor = document.getElementById('newsModalAuthor');
            const modalCategory = document.getElementById('newsModalCategory');
            const modalDescription = document.getElementById('newsModalDescription');
            const modalImage = document.getElementById('newsModalImage');
            const modalTags = document.getElementById('newsModalTags');
            const closeButton = document.getElementById('newsModalClose');
            let isLoading = false;
            let featuredRotateTimer = null;

            const closeModal = () => {
                modal.classList.remove('open');
                modal.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            };

            const openModal = (button) => {
                modalTitle.textContent = button.dataset.title || '';
                modalDate.textContent = button.dataset.date || '';
                modalAuthor.textContent = button.dataset.author || '';
                modalCategory.textContent = button.dataset.category || '';
                modalDescription.textContent = button.dataset.full || '';
                modalImage.src = button.dataset.image || '';

                modalTags.innerHTML = '';
                const rawTags = (button.dataset.tags || '').split(',').map((tag) => tag.trim()).filter(Boolean);
                rawTags.forEach((tag) => {
                    const chip = document.createElement('span');
                    chip.className = 'news-tag-chip';
                    chip.textContent = `#${tag}`;
                    modalTags.appendChild(chip);
                });

                modal.classList.add('open');
                modal.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            };

            const parseFeaturedPool = () => {
                const payload = document.getElementById('featuredPoolData');
                if (!payload) {
                    return [];
                }

                try {
                    const parsed = JSON.parse(payload.textContent || '[]');
                    return Array.isArray(parsed) ? parsed : [];
                } catch (error) {
                    return [];
                }
            };

            const applyFeaturedArticle = (article) => {
                const featuredCard = document.getElementById('featuredNewsCard');
                if (!featuredCard || !article) {
                    return;
                }

                const featuredImage = document.getElementById('featuredNewsImage');
                const featuredDate = document.getElementById('featuredNewsDate');
                const featuredAuthor = document.getElementById('featuredNewsAuthor');
                const featuredCategory = document.getElementById('featuredNewsCategory');
                const featuredTitle = document.getElementById('featuredNewsTitle');
                const featuredExcerpt = document.getElementById('featuredNewsExcerpt');
                const featuredTags = document.getElementById('featuredNewsTags');
                const featuredReadMore = document.getElementById('featuredNewsReadMore');

                if (!featuredImage || !featuredDate || !featuredAuthor || !featuredCategory || !featuredTitle || !
                    featuredExcerpt || !featuredTags || !featuredReadMore) {
                    return;
                }

                featuredCard.dataset.featuredId = String(article.id ?? '');
                featuredImage.src = article.image || '';
                featuredImage.alt = article.title || 'Berita unggulan';
                featuredDate.textContent = article.date || '';
                featuredAuthor.textContent = article.author || '';
                featuredCategory.textContent = article.category || '';
                featuredTitle.textContent = article.title || '';
                featuredExcerpt.textContent = article.excerpt || '';

                featuredTags.innerHTML = '';
                const tags = Array.isArray(article.tags) ? article.tags : [];
                tags.forEach((tag) => {
                    const chip = document.createElement('span');
                    chip.className = 'news-tag-chip';
                    chip.textContent = `#${tag}`;
                    featuredTags.appendChild(chip);
                });

                featuredReadMore.dataset.title = article.title || '';
                featuredReadMore.dataset.date = article.date || '';
                featuredReadMore.dataset.author = article.author || '';
                featuredReadMore.dataset.category = article.category || '';
                featuredReadMore.dataset.image = article.image || '';
                featuredReadMore.dataset.tags = tags.join(', ');
                featuredReadMore.dataset.full = article.full_description || '';
            };

            const initFeaturedRotator = () => {
                if (featuredRotateTimer) {
                    window.clearInterval(featuredRotateTimer);
                    featuredRotateTimer = null;
                }

                const featuredCard = document.getElementById('featuredNewsCard');
                const featuredPool = parseFeaturedPool();

                if (!featuredCard || featuredPool.length <= 1) {
                    return;
                }

                featuredRotateTimer = window.setInterval(() => {
                    const livePool = parseFeaturedPool();
                    const liveCard = document.getElementById('featuredNewsCard');

                    if (!liveCard || livePool.length <= 1) {
                        if (featuredRotateTimer) {
                            window.clearInterval(featuredRotateTimer);
                            featuredRotateTimer = null;
                        }
                        return;
                    }

                    const currentId = Number(liveCard.dataset.featuredId || 0);
                    const currentIndex = livePool.findIndex((item) => Number(item.id) === currentId);
                    const safeIndex = currentIndex >= 0 ? currentIndex : 0;
                    const nextArticle = livePool[(safeIndex + 1) % livePool.length];

                    liveCard.style.transition = 'opacity .28s ease';
                    liveCard.style.opacity = '0.45';

                    window.setTimeout(() => {
                        applyFeaturedArticle(nextArticle);
                        const updatedCard = document.getElementById('featuredNewsCard');
                        if (updatedCard) {
                            updatedCard.style.opacity = '1';
                        }
                    }, 160);
                }, 5000);
            };

            const loadNewsContent = async (url, pushState = true) => {
                if (!url || url === '#' || isLoading) {
                    return;
                }

                const interactiveContainer = document.querySelector(interactiveSelector);
                if (!interactiveContainer) {
                    window.location.href = url;
                    return;
                }

                isLoading = true;
                interactiveContainer.classList.add('news-async-loading');

                try {
                    const response = await fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'text/html',
                        },
                    });

                    if (!response.ok) {
                        throw new Error('Gagal memuat konten berita');
                    }

                    const html = await response.text();
                    const parsed = new DOMParser().parseFromString(html, 'text/html');
                    const nextInteractiveContainer = parsed.querySelector(interactiveSelector);

                    if (!nextInteractiveContainer) {
                        window.location.href = url;
                        return;
                    }

                    interactiveContainer.replaceWith(nextInteractiveContainer);
                    initFeaturedRotator();
                    if (pushState) {
                        window.history.pushState({}, '', url);
                    }
                } catch (error) {
                    window.location.href = url;
                } finally {
                    const updatedContainer = document.querySelector(interactiveSelector);
                    if (updatedContainer) {
                        updatedContainer.classList.remove('news-async-loading');
                    }
                    isLoading = false;
                }
            };

            document.addEventListener('click', (event) => {
                const modalButton = event.target.closest('.open-news-modal');
                if (modalButton) {
                    event.preventDefault();
                    openModal(modalButton);
                    return;
                }

                const newsCard = event.target.closest('.news-card');
                if (newsCard) {
                    const btn = newsCard.querySelector('.open-news-modal');
                    if (btn) {
                        event.preventDefault();
                        openModal(btn);
                        return;
                    }
                }

                const ajaxLink = event.target.closest('[data-news-ajax-link]');
                if (!ajaxLink) {
                    return;
                }

                if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
                    return;
                }

                event.preventDefault();
                loadNewsContent(ajaxLink.href);
            });

            document.addEventListener('submit', (event) => {
                const ajaxForm = event.target.closest('[data-news-ajax-form]');
                if (!ajaxForm) {
                    return;
                }

                event.preventDefault();

                const url = new URL(ajaxForm.action, window.location.origin);
                const formData = new FormData(ajaxForm);

                for (const [key, value] of formData.entries()) {
                    const normalizedValue = String(value).trim();
                    if (normalizedValue !== '') {
                        url.searchParams.set(key, normalizedValue);
                    } else {
                        url.searchParams.delete(key);
                    }
                }

                url.searchParams.delete('page');
                loadNewsContent(url.toString());
            });

            window.addEventListener('popstate', () => {
                loadNewsContent(window.location.href, false);
            });

            initFeaturedRotator();

            closeButton.addEventListener('click', closeModal);

            modal.addEventListener('click', (event) => {
                if (event.target === modal) {
                    closeModal();
                }
            });

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && modal.classList.contains('open')) {
                    closeModal();
                }
            });
        })();
    </script>
@endpush
