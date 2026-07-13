import { useReveal, usePageTitle } from '../hooks.js';
import Breadcrumb from '../components/Breadcrumb.jsx';
import Hero from '../sections/Hero.jsx';
import LogoCloud from '../sections/LogoCloud.jsx';
import Stats from '../sections/Stats.jsx';
import About from '../sections/About.jsx';
import Features from '../sections/Features.jsx';
import Services from '../sections/Services.jsx';
import HowItWorks from '../sections/HowItWorks.jsx';
import Experience from '../sections/Experience.jsx';
import TechStack from '../sections/TechStack.jsx';
import Benefits from '../sections/Benefits.jsx';
import Quote from '../sections/Quote.jsx';
import Projects from '../sections/Projects.jsx';
import Samples from '../sections/Samples.jsx';
import VideoShowcase from '../sections/VideoShowcase.jsx';
import ComparisonTable from '../sections/ComparisonTable.jsx';
import Testimonials from '../sections/Testimonials.jsx';
import Partners from '../sections/Partners.jsx';
import Team from '../sections/Team.jsx';
import PricingTable from '../sections/PricingTable.jsx';
import BlogPreview from '../sections/BlogPreview.jsx';
import Faq from '../sections/Faq.jsx';
import Newsletter from '../sections/Newsletter.jsx';
import Contact from '../sections/Contact.jsx';
import { profile } from '../content.js';

export default function Home() {
  usePageTitle('Ronnie Legaspi — Full Stack Developer');
  useReveal();

  return (
    <>
      <Breadcrumb items={[{ label: profile.name }]} />
      <Hero />
      <LogoCloud />
      <Stats />
      <About />
      <Features />
      <Services />
      <HowItWorks />
      <Experience />
      <TechStack />
      <Benefits />
      <Quote />
      <Projects />
      <VideoShowcase />
      <BlogPreview />
      <Samples />
      <ComparisonTable />
      <Testimonials />
      <Partners />
      <Team />
      <PricingTable />
      <Faq />
      <Newsletter />
      <Contact />
    </>
  );
}
