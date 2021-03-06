<?php
defined('PHPFOX') or exit('NO DICE!');

class Pautina_Component_Block_Profile_Musicbox extends Phpfox_Component
{
    public function process()
    {
        $aUser = $this->getParam('aUser');
        if (!$aUser) {
            return false;
        }

        $loginUserId = Phpfox::getUserId();

        $showAddLink = false;
        if ($loginUserId == $aUser['user_id']) {
            $showAddLink = true;
        }

        $musicboxService = Phpfox::getService('pautina.profile.musicbox');

        $musics = $musicboxService->getMusics($aUser['user_id']);
        $musicCount = $musicboxService->getMusicCount($aUser['user_id']);

        $this->template()->assign(
            array(
                'musics' => $musics,
                'musicCount' => $musicCount,
                'showAddLink'   => $showAddLink,
                'moduleUrl'     => Phpfox::getService('user')->getLink($aUser['user_id']) . 'music/'
            )
        );

        return 'block';
    }
}
?>