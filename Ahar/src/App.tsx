import React, { useState } from 'react';
import { ChevronLeft, ChevronRight, Instagram, Facebook, Twitter, Menu, X } from 'lucide-react';

const quotes = [
  {
    text: "Yoga means addition - addition of energy, strength, and beauty to body, mind, and soul.",
    author: "Amit Ray"
  },
  {
    text: "In asana practice, we learn to cherish each breath, to cherish every cell in our bodies. The time we spend on the mat is love in action.",
    author: "Rolf Gates"
  },
  {
    text: "The mind is madness. Only when you go beyond the mind, will there be Meditation.",
    author: "Sadhguru"
  }
];

function App() {
  const [isMenuOpen, setIsMenuOpen] = useState(false);

  return (
    <div className="min-h-screen">
      {/* Header section */}
      <header className="header">
        <div className="header-container">
          <div className="logo-container">
            <img 
              src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&w=100&q=80" 
              className="logo-image" 
              alt="Logo" 
            />
            <span className="logo-text">AaharYog</span>
          </div>
          
          <button 
            className="menu-button"
            onClick={() => setIsMenuOpen(!isMenuOpen)}
          >
            {isMenuOpen ? <X /> : <Menu />}
          </button>

          <nav className="nav-desktop">
            <a href="#" className="nav-link">HOME</a>
            <a href="#" className="nav-link">SERVICES</a>
            <a href="#" className="nav-link">ABOUT US</a>
            <button className="login-button">
              Lucifer
            </button>
          </nav>
        </div>

        {isMenuOpen && (
          <nav className="nav-mobile">
            <div className="nav-content">
              <a href="#" className="nav-link">HOME</a>
              <a href="#" className="nav-link">SERVICES</a>
              <a href="#" className="nav-link">ABOUT US</a>
              <button className="login-button">
                Lucifer
              </button>
            </div>
          </nav>
        )}
      </header>

      {/* Hero Slider section */}
      <div className="hero">
        <div className="hero-image-container">
          <img 
            src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&w=1920&q=80" 
            className="hero-image"
            alt="Yoga"
          />
        </div>
        <button className="slider-button left">
          <ChevronLeft />
        </button>
        <button className="slider-button right">
          <ChevronRight />
        </button>
      </div>

      {/* Quotes section */}
      <section className="quotes-section">
        <div className="quotes-container">
          <div className="quotes-content">
            <img 
              src="https://images.unsplash.com/photo-1552196563-55cd4e45efb3?auto=format&fit=crop&w=300&q=80"
              className="meditation-image"
              alt="Meditation"
            />
            <div className="quotes-list">
              {quotes.map((quote, index) => (
                <div key={index} className="quote">
                  "{quote.text}"
                  <div className="quote-author">- {quote.author}</div>
                </div>
              ))}
            </div>
          </div>
        </div>
      </section>

      {/* Services Section */}
      <section className="services-section">
        <div className="container">
          <div className="services-grid">
            {/* YOGA */}
            <div className="service-card">
              <div className="service-image-container">
                <img 
                  src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&w=600&q=80"
                  className="service-image"
                  alt="Yoga"
                />
              </div>
              <div className="service-content">
                <h3 className="service-title">YOGA</h3>
                <ul className="service-list">
                  <li>Deep Practice of Yoga</li>
                  <li>Meditation</li>
                  <li>Increased Flexibility</li>
                </ul>
              </div>
            </div>

            {/* Workout */}
            <div className="service-card">
              <div className="service-image-container">
                <img 
                  src="https://images.unsplash.com/photo-1534258936925-c58bed479fcb?auto=format&fit=crop&w=600&q=80"
                  className="service-image"
                  alt="Workout"
                />
              </div>
              <div className="service-content">
                <h3 className="service-title">Workout</h3>
                <ul className="service-list">
                  <li>Deep Practice of Yoga</li>
                  <li>Meditation</li>
                  <li>Increased Flexibility</li>
                </ul>
              </div>
            </div>

            {/* GYM */}
            <div className="service-card">
              <div className="service-image-container">
                <img 
                  src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&w=600&q=80"
                  className="service-image"
                  alt="GYM"
                />
              </div>
              <div className="service-content">
                <h3 className="service-title">GYM</h3>
                <ul className="service-list">
                  <li>Deep Practice of Yoga</li>
                  <li>Meditation</li>
                  <li>Increased Flexibility</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Daily Workout Section */}
      <section className="daily-workout">
        <div className="container">
          <div className="workout-container">
            <img 
              src="https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?auto=format&fit=crop&w=1600&q=80"
              className="workout-image"
              alt="Daily Workout"
            />
            <div className="workout-content">
              <h2 className="workout-title">Daily Workout</h2>
              <ul className="workout-list">
                <li>Simple Workout</li>
                <li>Easy to learn</li>
                <li>Highly effective</li>
                <li>Take less Time</li>
                <li>Suitable for all age groups</li>
                <li>Combination of Yoga Workout and Gym work</li>
              </ul>
            </div>
          </div>
        </div>
      </section>

      {/* Footer section */}
      <footer className="footer">
        <div className="container">
          <div className="footer-container">
            <div className="footer-brand-container">
              <div className="footer-logo">
                <div className="footer-logo-circle"></div>
                <span className="footer-brand">AaharYog</span>
              </div>
              <p className="footer-tagline">STAY FIT, STAY HAPPY</p>
            </div>
            <div className="footer-contact">
              <p className="footer-name">ANAND</p>
              <p className="footer-info">+91 0123456789</p>
              <p className="footer-info">AAHARYOG2023@GMAIL.COM</p>
            </div>
            <div className="social-links">
              <Facebook className="social-icon" />
              <Instagram className="social-icon" />
              <Twitter className="social-icon" />
            </div>
          </div>
        </div>
      </footer>
    </div>
  );
}

export default App;