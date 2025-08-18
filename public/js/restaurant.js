// public/js/restaurant.js
document.addEventListener('DOMContentLoaded', () => {

    /* ============ 1) Intro (fade) ============ */
    const intro = document.querySelector('.rest-intro');
    const enterBtn = document.getElementById('restEnter');
    const page = document.getElementById('rest-page');

    const closeIntro = () => {
        if (!intro || intro.classList.contains('is-off')) return;
        intro.classList.add('is-off');
        setTimeout(() => {
            intro.style.display = 'none';
            if (page) {
                page.style.opacity = '1';
                page.animate(
                    [{opacity:0, transform:'translateY(6px)'},{opacity:1, transform:'none'}],
                    {duration:320, easing:'ease-out'}
                );
            }
        }, 420);
    };

    if (enterBtn) enterBtn.addEventListener('click', closeIntro);
    // auto-fallback si besoin
    setTimeout(closeIntro, 1800);

    /* ============ 2) Reveal on scroll ============ */
    const reveals = document.querySelectorAll('.reveal');
    if (reveals.length){
        if ('IntersectionObserver' in window){
            const io = new IntersectionObserver((entries)=>{
                entries.forEach(en=>{
                    if(en.isIntersecting){
                        en.target.classList.add('in');
                        io.unobserve(en.target);
                    }
                });
            }, {threshold:.18});
            reveals.forEach(el=>io.observe(el));
        } else {
            reveals.forEach(el=>el.classList.add('in'));
        }
    }

    /* ============ 3) Filtres ============ */
    const grid = document.getElementById('galleryGrid');
    const btns = document.querySelectorAll('.gf-btn');
    if (grid && btns.length){
        btns.forEach(btn=>{
            btn.addEventListener('click', ()=>{
                btns.forEach(b=>b.classList.remove('is-active'));
                btn.classList.add('is-active');
                const f = btn.dataset.filter;
                grid.querySelectorAll('.g-item').forEach(it=>{
                    const cat = it.getAttribute('data-cat');
                    it.classList.toggle('is-hidden', !(f==='all' || f===cat));
                });
            });
        });
    }

    /* ============ 4) Lightbox ============ */
    const lb = document.getElementById('lightbox');
    const lbImg = document.getElementById('lightboxImg');
    const lbClose = lb?.querySelector('.lb-close');

    const openLB = (src) => {
        if (!lb || !lbImg) return;
        lbImg.src = src;
        lb.classList.add('is-open');
        document.documentElement.style.overflow = 'hidden';
        document.body.style.overflow = 'hidden';
    };
    const closeLB = () => {
        if (!lb) return;
        lb.classList.remove('is-open');
        document.documentElement.style.overflow = '';
        document.body.style.overflow = '';
        setTimeout(()=>{ if(lbImg) lbImg.src=''; }, 200);
    };

    document.addEventListener('click', (e)=>{
        const wrap = e.target.closest('.g-photo');
        if (wrap && wrap.dataset.full){
            e.preventDefault();
            openLB(wrap.dataset.full);
        }
    });
    lbClose?.addEventListener('click', closeLB);
    lb?.addEventListener('click', (e)=>{ if (e.target === lb) closeLB(); });
    window.addEventListener('keydown', (e)=>{ if (e.key === 'Escape') closeLB(); }, {passive:true});
});
