<?php
class Version20210405152359 implements \Hlis\Migration\Script
{
    /**
     * Commits changes
     */
    public function up(): void
    {
        SQL("CREATE INDEX game_manufacturers_is_open_index ON game_manufacturers (is_open);");
        SQL("CREATE INDEX game_play__patterns_isMobile_index ON game_play__patterns (isMobile);");
        SQL("CREATE INDEX games_is_open_index ON games (is_open);");
        SQL("CREATE INDEX games_date_launched_id_index ON games (date_launched DESC, id DESC);");
    }
    
    /**
     * Rolls back changes
     */
    public function down(): void
    {
        
    }
}

