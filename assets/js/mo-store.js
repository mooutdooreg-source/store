(function () {
	'use strict';

	const doc = document;
	const win = window;
	const html = doc.documentElement;

	const settings = win.moStoreSettings || {};

	const prefersReducedMotion = win.matchMedia && win.matchMedia('(prefers-reduced-motion: reduce)').matches;

	const qs = (selector, context = doc) => context.querySelector(selector);
	const qsa = (selector, context = doc) => Array.prototype.slice.call(context.querySelectorAll(selector));

	const on = (element, eventName, handler, options) => {
		if (!element) {
			return;
		}

		element.addEventListener(eventName, handler, options || false);
	};

	const setMessage = (element, title, message, type) => {
		if (!element) {
			return;
		}

		element.classList.remove('is-success', 'is-error');

		if (type) {
			element.classList.add(`is-${type}`);
		}

		const safeTitle = title ? `<strong>${escapeHtml(title)}</strong>` : '';
		const safeMessage = message ? `<span>${escapeHtml(message)}</span>` : '';

		element.innerHTML = [safeTitle, safeMessage].filter(Boolean).join('<br>');
	};

	const escapeHtml = (value) => {
		const div = doc.createElement('div');
		div.textContent = String(value || '');
		return div.innerHTML;
	};

	const postForm = async (form) => {
		const formData = new FormData(form);
		const ajaxUrl = settings.ajaxUrl || '/wp-admin/admin-ajax.php';

		const response = await fetch(ajaxUrl, {
			method: 'POST',
			credentials: 'same-origin',
			body: formData
		});

		const payload = await response.json().catch(() => null);

		if (!response.ok || !payload) {
			throw new Error('Request failed.');
		}

		if (!payload.success) {
			throw new Error(payload.data && payload.data.message ? payload.data.message : 'Request failed.');
		}

		return payload.data || {};
	};

	const initNavbar = () => {
		const navbar = qs('[data-mo-navbar]');
		const toggle = qs('[data-mo-menu-toggle]', navbar);
		const menu = qs('[data-mo-mobile-menu]', navbar);

		if (!navbar) {
			return;
		}

		const updateScrolled = () => {
			navbar.classList.toggle('is-scrolled', win.scrollY > 18);
		};

		const closeMenu = () => {
			if (!toggle || !menu) {
				return;
			}

			navbar.classList.remove('is-open');
			toggle.setAttribute('aria-expanded', 'false');
			menu.hidden = true;
			html.classList.remove('mo-menu-open');
		};

		const openMenu = () => {
			if (!toggle || !menu) {
				return;
			}

			navbar.classList.add('is-open');
			toggle.setAttribute('aria-expanded', 'true');
			menu.hidden = false;
			html.classList.add('mo-menu-open');
		};

		on(win, 'scroll', updateScrolled, { passive: true });
		updateScrolled();

		on(toggle, 'click', () => {
			const isOpen = navbar.classList.contains('is-open');

			if (isOpen) {
				closeMenu();
			} else {
				openMenu();
			}
		});

		qsa('a[href*="#"]', navbar).forEach((link) => {
			on(link, 'click', () => {
				closeMenu();
			});
		});

		on(doc, 'keydown', (event) => {
			if (event.key === 'Escape') {
				closeMenu();
			}
		});
	};

	const initHeroSlideshow = () => {
		const slideshow = qs('[data-mo-hero-slideshow]');
		const slideDuration = 9800;

		if (!slideshow || prefersReducedMotion) {
			return;
		}

		const slides = qsa('[data-mo-hero-slide]', slideshow);
		const hero = slideshow.closest('.mo-hero');
		const progressSegments = hero ? qsa('[data-mo-hero-progress-segment]', hero) : [];
		const counterCurrent = hero ? qs('[data-mo-hero-current]', hero) : null;

		if (slides.length < 2) {
			return;
		}

		let activeIndex = slides.findIndex((slide) => slide.classList.contains('is-active'));

		if (activeIndex < 0) {
			activeIndex = 0;
			slides[0].classList.add('is-active');
		}

		const updateCounter = () => {
			if (counterCurrent) {
				counterCurrent.textContent = String(activeIndex + 1).padStart(2, '0');
			}
		};

		updateCounter();

		const setActiveSlide = (index) => {
			slides[activeIndex].classList.remove('is-active');

			if (progressSegments[activeIndex]) {
				progressSegments[activeIndex].classList.remove('is-active');
			}

			activeIndex = index;
			slides[activeIndex].classList.add('is-active');

			if (progressSegments[activeIndex]) {
				progressSegments[activeIndex].classList.add('is-active');
			}

			updateCounter();
		};

		win.setInterval(() => {
			setActiveSlide((activeIndex + 1) % slides.length);
		}, slideDuration);
	};

	const removeSkeletonWhenLoaded = () => {
		const skeletonCards = qsa('.skeleton');

		skeletonCards.forEach((card) => {
			const media = qsa('img, video', card);

			if (!media.length) {
				card.classList.add('is-loaded');
				return;
			}

			let loadedCount = 0;

			const markLoaded = () => {
				loadedCount += 1;

				if (loadedCount >= media.length) {
					card.classList.add('is-loaded');
				}
			};

			media.forEach((item) => {
				if (item.tagName.toLowerCase() === 'img') {
					if (item.complete) {
						markLoaded();
					} else {
						on(item, 'load', markLoaded, { once: true });
						on(item, 'error', markLoaded, { once: true });
					}
				} else {
					on(item, 'loadeddata', markLoaded, { once: true });
					on(item, 'error', markLoaded, { once: true });
				}
			});
		});
	};

	const createDragScroll = (track) => {
		if (!track) {
			return;
		}

		let isDown = false;
		let startX = 0;
		let scrollLeft = 0;
		let hasDragged = false;

		on(track, 'pointerdown', (event) => {
			if (event.button !== 0) {
				return;
			}

			isDown = true;
			hasDragged = false;
			startX = event.pageX;
			scrollLeft = track.scrollLeft;
			track.classList.add('is-dragging');
			track.setPointerCapture(event.pointerId);
		});

		on(track, 'pointermove', (event) => {
			if (!isDown) {
				return;
			}

			const delta = event.pageX - startX;

			if (Math.abs(delta) > 6) {
				hasDragged = true;
			}

			track.scrollLeft = scrollLeft - delta;
		});

		const endDrag = (event) => {
			if (!isDown) {
				return;
			}

			isDown = false;
			track.classList.remove('is-dragging');

			if (track.hasPointerCapture && track.hasPointerCapture(event.pointerId)) {
				track.releasePointerCapture(event.pointerId);
			}
		};

		on(track, 'pointerup', endDrag);
		on(track, 'pointercancel', endDrag);
		on(track, 'mouseleave', () => {
			isDown = false;
			});

		on(track, 'click', (event) => {
			if (hasDragged) {
				event.preventDefault();
				event.stopPropagation();
				hasDragged = false;
			}
		}, true);
	};

	const updateProgress = (track, progress) => {
		if (!track || !progress) {
			return;
		}

		const maxScroll = track.scrollWidth - track.clientWidth;

		if (maxScroll <= 0) {
			progress.style.width = '100%';
			progress.style.transform = 'scaleX(1)';
			return;
		}

		const visibleRatio = Math.max(track.clientWidth / track.scrollWidth, 0.12);
		const scrollRatio = track.scrollLeft / maxScroll;

		progress.style.width = `${visibleRatio * 100}%`;
		progress.style.transform = `translateX(${scrollRatio * (100 / visibleRatio - 100)}%)`;
	};

	const initHomeLinesSlider = () => {
		const slider = qs('[data-mo-lines-slider]');

		if (!slider) {
			return;
		}

		const track = qs('[data-mo-slider-track]', slider);

		if (!track) {
			return;
		}

		const cards = qsa('[data-mo-slider-card]', track);

		if (!cards.length) {
			return;
		}

		createDragScroll(track);

		if (cards.length < 2) {
			return;
		}

		const prepareClone = (card) => {
			const clone = card.cloneNode(true);

			clone.dataset.moSliderClone = 'true';
			clone.classList.add('is-loaded');
			clone.setAttribute('aria-hidden', 'true');
			clone.removeAttribute('id');

			qsa('[id]', clone).forEach((element) => element.removeAttribute('id'));
			qsa('a, button, input, select, textarea, [tabindex]', clone).forEach((element) => {
				element.setAttribute('tabindex', '-1');
			});

			return clone;
		};

		const before = doc.createDocumentFragment();
		const after = doc.createDocumentFragment();

		cards.forEach((card) => {
			before.appendChild(prepareClone(card));
			after.appendChild(prepareClone(card));
		});

		track.insertBefore(before, cards[0]);
		track.appendChild(after);

		let allCards = qsa('[data-mo-slider-card]', track);
		let setStart = cards.length;
		let setWidth = 0;
		let isAdjusting = false;

		const cardCenterScroll = (card) => card.offsetLeft - ((track.clientWidth - card.offsetWidth) / 2);

		const measure = () => {
			allCards = qsa('[data-mo-slider-card]', track);

			const first = allCards[setStart];
			const nextSetFirst = allCards[setStart + cards.length];

			if (!first || !nextSetFirst) {
				setWidth = 0;
				return;
			}

			setWidth = cardCenterScroll(nextSetFirst) - cardCenterScroll(first);
		};

		const centerCard = (index, behavior = 'auto') => {
			const card = allCards[setStart + index];

			if (!card) {
				return;
			}

			track.scrollTo({
				left: cardCenterScroll(card),
				behavior
			});
		};

		const rebalance = () => {
			if (!setWidth || isAdjusting || track.classList.contains('is-dragging')) {
				return;
			}

			const first = allCards[setStart];
			const firstCenter = first ? cardCenterScroll(first) : 0;
			const leftLimit = firstCenter - (setWidth * 0.5);
			const rightLimit = firstCenter + (setWidth * 1.5);

			if (track.scrollLeft < leftLimit) {
				isAdjusting = true;
				track.scrollLeft += setWidth;
				isAdjusting = false;
			} else if (track.scrollLeft > rightLimit) {
				isAdjusting = true;
				track.scrollLeft -= setWidth;
				isAdjusting = false;
			}
		};

		const refresh = () => {
			measure();
			rebalance();
		};

		on(track, 'scroll', refresh, { passive: true });
		on(track, 'pointerup', () => win.requestAnimationFrame(rebalance));
		on(track, 'pointercancel', () => win.requestAnimationFrame(rebalance));
		on(win, 'resize', () => {
			measure();
			centerCard(Math.min(1, cards.length - 1));
		});

		win.requestAnimationFrame(() => {
			measure();
			centerCard(Math.min(1, cards.length - 1));
		});
	};

	const initLineMediaSliders = () => {
		qsa('[data-mo-line-media-slider]').forEach((slider) => {
			const track = qs('[data-mo-line-media-track]', slider);
			const progress = qs('[data-mo-line-media-progress]', slider);

			if (!track) {
				return;
			}

			createDragScroll(track);

			const refresh = () => updateProgress(track, progress);

			on(track, 'scroll', refresh, { passive: true });
			on(win, 'resize', refresh);
			refresh();
		});
	};

	const initObservedVideos = () => {
		const videos = qsa('[data-mo-observe-video]');

		if (!videos.length) {
			return;
		}

		if (!('IntersectionObserver' in win) || prefersReducedMotion) {
			videos.forEach((video) => {
				video.pause();
			});
			return;
		}

		const observer = new IntersectionObserver((entries) => {
			entries.forEach((entry) => {
				const video = entry.target;

				if (entry.isIntersecting && entry.intersectionRatio > 0.45) {
					video.play().catch(() => {});
				} else {
					video.pause();
				}
			});
		}, {
			threshold: [0, 0.45, 0.75]
		});

		videos.forEach((video) => observer.observe(video));
	};

	const initMediaViewers = () => {
		qsa('[data-mo-line-media-slider]').forEach((slider) => {
			const section = slider.closest('.mo-line-media');
			const viewer = section ? qs('[data-mo-media-viewer]', section) : null;
			const cards = qsa('[data-mo-media-card]', slider);

			if (!viewer || !cards.length) {
				return;
			}

			const stage = qs('[data-mo-media-stage]', viewer);
			const name = qs('[data-mo-media-name]', viewer);
			const close = qs('[data-mo-media-close]', viewer);
			const prev = qs('[data-mo-media-prev]', viewer);
			const next = qs('[data-mo-media-next]', viewer);

			let currentIndex = 0;
			let touchStartX = 0;

			const getCardData = (index) => {
				const card = cards[index];

				if (!card) {
					return null;
				}

				return {
					type: card.getAttribute('data-type') || 'image',
					src: card.getAttribute('data-src') || '',
					poster: card.getAttribute('data-poster') || '',
					name: card.getAttribute('data-name') || ''
				};
			};

			const render = (index) => {
				const data = getCardData(index);

				if (!data || !stage) {
					return;
				}

				currentIndex = index;
				stage.innerHTML = '';

				let element;

				if (data.type === 'video') {
					element = doc.createElement('video');
					element.src = data.src;
					element.poster = data.poster;
					element.controls = true;
					element.autoplay = true;
					element.muted = true;
					element.loop = true;
					element.playsInline = true;
				} else {
					element = doc.createElement('img');
					element.src = data.src;
					element.alt = data.name;
					element.decoding = 'async';
				}

				stage.appendChild(element);

				if (name) {
					name.textContent = data.name;
				}
			};

			const openViewer = (index) => {
				render(index);
				viewer.classList.add('is-open');
				viewer.setAttribute('aria-hidden', 'false');
				html.classList.add('mo-media-viewer-open');

				if (close) {
					close.focus({ preventScroll: true });
				}
			};

			const closeViewer = () => {
				viewer.classList.remove('is-open');
				viewer.setAttribute('aria-hidden', 'true');
				html.classList.remove('mo-media-viewer-open');

				if (stage) {
					qsa('video', stage).forEach((video) => video.pause());
					stage.innerHTML = '';
				}
			};

			const showPrev = () => {
				const index = currentIndex <= 0 ? cards.length - 1 : currentIndex - 1;
				render(index);
			};

			const showNext = () => {
				const index = currentIndex >= cards.length - 1 ? 0 : currentIndex + 1;
				render(index);
			};

			cards.forEach((card, index) => {
				on(card, 'click', () => openViewer(index));
			});

			on(close, 'click', closeViewer);
			on(prev, 'click', showPrev);
			on(next, 'click', showNext);

			on(viewer, 'click', (event) => {
				if (event.target === viewer) {
					closeViewer();
				}
			});

			on(viewer, 'touchstart', (event) => {
				touchStartX = event.changedTouches[0].clientX;
			}, { passive: true });

			on(viewer, 'touchend', (event) => {
				const touchEndX = event.changedTouches[0].clientX;
				const delta = touchEndX - touchStartX;

				if (Math.abs(delta) < 45) {
					return;
				}

				if (delta > 0) {
					showPrev();
				} else {
					showNext();
				}
			}, { passive: true });

			on(doc, 'keydown', (event) => {
				if (!viewer.classList.contains('is-open')) {
					return;
				}

				if (event.key === 'Escape') {
					closeViewer();
				}

				if (event.key === 'ArrowLeft') {
					showPrev();
				}

				if (event.key === 'ArrowRight') {
					showNext();
				}
			});
		});
	};

	const initPreferenceForm = () => {
		const form = qs('[data-mo-preference-form]');

		if (!form) {
			return;
		}

		const options = qsa('[data-mo-preference-option]', form);
		const valueInput = qs('[data-mo-preference-value]', form);
		const submit = qs('[data-mo-preference-submit]', form);
		const message = qs('[data-mo-preference-message]', form);

		options.forEach((option) => {
			on(option, 'click', () => {
				options.forEach((item) => {
					item.classList.remove('is-selected');
					item.setAttribute('aria-selected', 'false');
				});

				option.classList.add('is-selected');
				option.setAttribute('aria-selected', 'true');

				if (valueInput) {
					valueInput.value = option.getAttribute('data-value') || '';
				}

				if (submit) {
					submit.disabled = !valueInput || !valueInput.value;
				}

				setMessage(message, '', '', '');
			});
		});

		on(form, 'submit', async (event) => {
			event.preventDefault();

			if (!valueInput || !valueInput.value) {
				setMessage(message, '', 'Please choose a direction before submitting.', 'error');
				return;
			}

			if (submit) {
				submit.disabled = true;
				submit.classList.add('is-loading');
			}

			try {
				const payload = await postForm(form);
				setMessage(
					message,
					payload.title || (settings.preferenceSuccess && settings.preferenceSuccess.title) || 'Thanks — your preference has been noted.',
					payload.message || (settings.preferenceSuccess && settings.preferenceSuccess.message) || 'It will help shape future MO Store batches.',
					'success'
				);
				form.classList.add('is-submitted');
			} catch (error) {
				setMessage(message, '', error.message || 'Please try again.', 'error');

				if (submit) {
					submit.disabled = false;
				}
			} finally {
				if (submit) {
					submit.classList.remove('is-loading');
				}
			}
		});
	};

	const initInterestForms = () => {
		qsa('[data-mo-interest-form]').forEach((form) => {
			const submit = qs('button[type="submit"]', form);
			const message = qs('[data-mo-interest-message]', form);

			on(form, 'submit', async (event) => {
				event.preventDefault();

				if (submit) {
					submit.disabled = true;
					submit.classList.add('is-loading');
				}

				setMessage(message, '', '', '');

				try {
					const payload = await postForm(form);
					setMessage(
						message,
						payload.title || 'You are on the MO Store first access list.',
						payload.message || 'We will email you before the July release opens.',
						'success'
					);

					form.reset();

					const select = qs('select[name="line"]', form);

					if (select && select.dataset.defaultValue) {
						select.value = select.dataset.defaultValue;
					}
				} catch (error) {
					setMessage(message, '', error.message || 'Please try again.', 'error');
				} finally {
					if (submit) {
						submit.disabled = false;
						submit.classList.remove('is-loading');
					}
				}
			});
		});
	};

	const initSmoothAnchors = () => {
		qsa('a[href^="#"]').forEach((link) => {
			on(link, 'click', (event) => {
				const targetId = link.getAttribute('href');

				if (!targetId || targetId === '#') {
					return;
				}

				const target = qs(targetId);

				if (!target) {
					return;
				}

				event.preventDefault();

				target.scrollIntoView({
					behavior: prefersReducedMotion ? 'auto' : 'smooth',
					block: 'start'
				});
			});
		});
	};

	const init = () => {
		initNavbar();
		initHeroSlideshow();
		removeSkeletonWhenLoaded();
		initHomeLinesSlider();
		initLineMediaSliders();
		initObservedVideos();
		initMediaViewers();
		initPreferenceForm();
		initInterestForms();
		initSmoothAnchors();
	};

	if (doc.readyState === 'loading') {
		on(doc, 'DOMContentLoaded', init);
	} else {
		init();
	}
})();
