function data() {
    function getThemeFromLocalStorage() {
      // if user already changed the theme, use it
      if (window.localStorage.getItem('dark')) {
        return JSON.parse(window.localStorage.getItem('dark'));
      }

      // else return their preferences
      return (
        !!window.matchMedia &&
        window.matchMedia('(prefers-color-scheme: dark)').matches
      );
    }

    function setThemeToLocalStorage(value) {
      window.localStorage.setItem('dark', value);
    }

    return {
      dark: getThemeFromLocalStorage(),
      toggleTheme() {
        this.dark = !this.dark;
        setThemeToLocalStorage(this.dark);
      },
      isSideMenuOpen: false,
      toggleSideMenu() {
        this.isSideMenuOpen = !this.isSideMenuOpen;
      },
      closeSideMenu() {
        this.isSideMenuOpen = false;
      },
      isNotificationsMenuOpen: false,
      toggleNotificationsMenu() {
        this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen;
      },
      closeNotificationsMenu() {
        this.isNotificationsMenuOpen = false;
      },
      isProfileMenuOpen: false,
      toggleProfileMenu() {
        this.isProfileMenuOpen = !this.isProfileMenuOpen;
      },
      closeProfileMenu() {
        this.isProfileMenuOpen = false;
      },
      isMenuOpenMap: {},
      toggleMenu(menuId) {
          this.isMenuOpenMap[menuId] = !this.isMenuOpenMap[menuId];
      },
      isMenuOpen(menuId) {
          return this.isMenuOpenMap[menuId] || false;
      },
        // Modal
        modalMap: {},
        trapCleanup: null,
        openModal(modalId) {
        this.modalMap[modalId] = true;
        this.trapCleanup = focusTrap(document.querySelector(`#${modalId}`));
        },
        closeModal(modalId) {
        this.modalMap[modalId] = false;
        if (this.trapCleanup) {
            this.trapCleanup();
        }
        },
        isModalOpen(modalId) {
        return this.modalMap[modalId] || false;
        },
    };
  }

  document.addEventListener('alpine:init', () => {
    Alpine.data('app', data);
  });
