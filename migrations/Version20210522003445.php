<?php
class Version20210522003445 implements \Hlis\Migration\Script
{
    /**
     * Commits changes
     */
    public function up(): void
    {
        SQL("INSERT INTO pages (url, head_description, head_title, body_title) VALUES ('offline', 'We\'re sorry this page hasn\'t been cached yet', 'You\'re offline now', 'We\'re sorry this page hasn\'t been cached yet');");
    }
    
    /**
     * Rolls back changes
     */
    public function down(): void
    {
        
    }
}

