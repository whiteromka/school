<section class="section" id="contact">
    <div class="section-header">
        <div class="section-label">Contact</div>
        <h2 class="section-title">Open Channel</h2>
        <div class="section-divider" aria-hidden="true"></div>
    </div>

    <div class="contact-grid">
        <div class="contact-info-block">
            <div class="contact-method">
                <div class="contact-method-label">Encrypted Mail</div>
                <div class="contact-method-value">
                    <a href="mailto:ops@nexuscollective.io">{{ config('services.contacts.rom.email') }}</a>
                </div>
            </div>

            <div class="contact-method">
                <div class="contact-method-label">Secure Line</div>
                <div class="contact-method-value">+1 (212) 555-0147</div>
            </div>
            <div class="contact-method">
                <div class="contact-method-label">Network</div>
                <div class="contact-method-value">
                    <a href="#">X/Twitter</a> &mdash;
                    <a href="#">LinkedIn</a> &mdash;
                    <a href="#">GitHub</a>
                </div>
            </div>
            <div class="contact-method">
                <div class="contact-method-label">Primary Node</div>
                <div class="contact-method-value">New York City, NY</div>
            </div>
        </div>

        <form class="contact-form" aria-label="Contact form">
            <div class="form-group">
                <label for="name">Identifier</label>
                <input type="text" id="name" name="name" placeholder="Your name" autocomplete="name" />
            </div>
            <div class="form-group">
                <label for="email">Comm Channel</label>
                <input type="email" id="email" name="email" placeholder="your@email.com" autocomplete="email" />
            </div>
            <div class="form-group">
                <label for="message">Transmission</label>
                <textarea id="message" name="message" placeholder="Describe your mission..."></textarea>
            </div>
            <button class="btn" type="submit">Transmit Message</button>
        </form>
    </div>
</section>
