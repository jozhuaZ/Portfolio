<!-- contacts -->
<section id="contact" class="contact">
    <div class="section-content">
        <h2 class="heading-title">Contact Me</h2>
        <div class="contact-content">
            <!--  Collaboration & Info -->
            <div class="contact-info">
                <div class="info-text">
                    <h3>Let's Collaborate and Build Something Great!</h3>
                    <p>I'm always open to discussing new projects, creative ideas, or opportunities to be part of your vision. Feel free to reach out directly via email or connect with me on social media. I look forward to hearing about your ideas!</p>

                    <div class="contact-detail">
                        <!-- Icon for Email -->
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon-mail">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        <a href="mailto:joshuazabala693@gmail.com">joshuazabala693@gmail.com</a>
                    </div>
                </div>

                <!-- Social Links at the bottom left -->
                <div class="social-links">
                    <a href="https://www.github.com/jozhuaZ" target="_blank" class="social-icon github" aria-label="Github Profile">
                        <!-- GitHub Icon SVG (Use your existing accent colors) -->
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 0C5.372 0 0 5.372 0 12c0 5.303 3.438 9.8 8.207 11.385.6.111.82-.257.82-.57 0-.28-.01-1.017-.015-2.001-3.337.724-4.043-1.611-4.043-1.611-.546-1.384-1.332-1.753-1.332-1.753-1.089-.745.083-.73.083-.73 1.205.084 1.838 1.234 1.838 1.234 1.07 1.832 2.808 1.303 3.493.996.108-.775.419-1.303.76-1.603-2.665-.304-5.466-1.332-5.466-5.93 0-1.31.468-2.383 1.233-3.224-.124-.304-.535-1.524.117-3.176 0 0 1.006-.322 3.3-1.232 0 0 .954-.265 1.85-.27 0 0 .9-.005 1.85.27 2.295.91 3.3 1.232 3.3 1.232.652 1.652.24 2.872.118 3.176.764.841 1.232 1.914 1.232 3.224 0 4.61-2.805 5.623-5.474 5.922.43.37.817 1.107.817 2.233 0 1.614-.015 2.915-.015 3.314 0 .317.218.682.827.568C20.562 21.8 24 17.303 24 12 24 5.372 18.628 0 12 0z" />
                        </svg>
                    </a>
                    <a href="https://www.facebook.com/joshua.zabal.1/" target="_blank" class="social-icon facebook" aria-label="Facebook Profile">
                        <!-- Facebook Icon SVG -->
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12c5.961 0 10.994-4.321 11.885-10.027.126-.816.19-1.642.19-2.473 0-6.627-5.373-12-12-12zm-2.028 17.218v-5.945h-1.996V9.664h1.996V7.781c0-1.984 1.185-3.07 3.018-3.07 1.981 0 3.018.148 3.018.148v3.313h-1.706c-.838 0-1.1.521-1.1 1.054v1.89h2.919l-.468 2.58h-2.451v5.945h-3.003z" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Contact Form -->
            <form class="contact-form">
                <div class="input-group">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" required placeholder="John Doe">
                </div>

                <div class="input-group">
                    <label for="email">Your Email</label>
                    <input type="email" id="email" name="email" required placeholder="name@example.com">
                </div>

                <div class="input-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" required placeholder="Project Inquiry">
                </div>

                <div class="input-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5" required placeholder="Let's build a stunning portfolio together.."></textarea>
                </div>

                <button type="submit" class="submit-button">
                    Send Message
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                </button>
                <p id="form-message" style="display: none; margin-top: 15px;"></p>
            </form>
        </div>
    </div>
</section>