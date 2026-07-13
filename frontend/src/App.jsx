import { useEffect } from 'react';
import { Routes, Route, useLocation } from 'react-router-dom';
import Navbar from './components/Navbar.jsx';
import Footer from './components/Footer.jsx';
import BackToTop from './components/BackToTop.jsx';
import CookieConsent from './components/CookieConsent.jsx';
import StaticWidgets from './components/StaticWidgets.jsx';
import { UnderConstructionProvider, UnderConstructionModal } from './components/UnderConstruction.jsx';
import Home from './pages/Home.jsx';
import Gallery from './pages/Gallery.jsx';
import Pricing from './pages/Pricing.jsx';
import BlogIndex from './pages/BlogIndex.jsx';
import BlogShow from './pages/BlogShow.jsx';
import NotFound from './pages/NotFound.jsx';

// On route change: honor #hash anchors, otherwise scroll to top
function ScrollManager() {
  const { pathname, hash } = useLocation();

  useEffect(() => {
    if (hash) {
      const el = document.getElementById(hash.slice(1));
      if (el) {
        el.scrollIntoView({ behavior: 'smooth' });
        return;
      }
    }
    window.scrollTo({ top: 0 });
  }, [pathname, hash]);

  return null;
}

export default function App() {
  return (
    <UnderConstructionProvider>
      <ScrollManager />
      <Navbar />

      <main className="pt-16">
        <Routes>
          <Route path="/" element={<Home />} />
          <Route path="/gallery" element={<Gallery />} />
          <Route path="/pricing" element={<Pricing />} />
          <Route path="/blog" element={<BlogIndex />} />
          <Route path="/blog/:slug" element={<BlogShow />} />
          <Route path="*" element={<NotFound />} />
        </Routes>
      </main>

      <Footer />
      <BackToTop />
      <CookieConsent />
      <StaticWidgets />
      <UnderConstructionModal />
    </UnderConstructionProvider>
  );
}
