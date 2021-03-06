<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ProgramTable extends Doctrine_Table
{
    public function load($id = null)
    {
        if($id == null)
            return array();

        $lang = sfContext::getInstance()->getUser()->getCulture();

        return Doctrine_Query::create()
                                ->from('Program p')
                                ->leftJoin('p.Translation pt WITH pt.lang = ?',$lang)
                                ->leftJoin('p.Creator c')
                                ->leftJoin('p.Owner o')
                                ->leftJoin('p.Sets s')
                                ->leftJoin('s.Exercise e')
                                ->where('p.id = ?',array($id))
                                ->fetchOne();
    }

    public function loadForShow($id = null,$one_lang = true)
    {
        if($id == null)
            return array();

        $lang = sfContext::getInstance()->getUser()->getCulture();

        if($one_lang)
            return Doctrine_Query::create()
                                ->from('Program p')
                                ->leftJoin('p.Translation pt WITH pt.lang = ?',$lang)
                                ->leftJoin('p.Creator c')
                                ->leftJoin('p.Owner o')
                                ->leftJoin('p.Sets s')
                                ->leftJoin('s.Exercise e')
                                ->leftJoin('e.Translation et WITH et.lang = ?', $lang)
                                ->where('p.id = ?',array($id))
                                ->fetchOne();
        else
            return Doctrine_Query::create()
                                ->from('Program p')
                                ->leftJoin('p.Translation pt')
                                ->leftJoin('p.Creator c')
                                ->leftJoin('p.Owner o')
                                ->leftJoin('p.Sets s')
                                ->leftJoin('s.Exercise e')
                                ->leftJoin('e.Translation et')
                                ->where('p.id = ?',array($id))
                                ->fetchOne();
    }

    public function getViewableQuery($u_id, $culture)
    {
        return Doctrine_Query::create()
                                ->select('p.*, t.name, o.username,c.username,COUNT(s.id) as num_exercises,*')
                                ->from('Program p')
                                ->leftJoin('p.Translation t WITH t.lang = ?',$culture)
                                ->leftJoin('p.Owner o')
                                ->leftJoin('p.Creator c')
                                ->leftJoin('p.Sets s')
                                ->where(' ( p.owner_id = ? ) OR ( p.is_shareable = ? ) ', array($u_id,true))
                                ->groupBy('p.id');
    }

    public function duplicate($id)
    {
        $data = Doctrine_Query::create()
                                ->from('Program p')
                                ->leftJoin('p.Translation pt')
                                ->leftJoin('p.Sets s')
                                ->leftJoin('s.Exercise e')
                                ->leftJoin('e.Translation et')
                                ->leftJoin('e.Images i')
                                ->leftJoin('i.Translation it')
                                ->where('p.id = ? AND p.is_shareable = ? ',array($id,true))
                                ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                                ->fetchOne();

        $new_images = array();
        $path       = sfConfig::get('sf_upload_dir').'/exercises/';
        $owner_id   = sfContext::getInstance()->getUser()->getId();
        sfContext::getInstance()->getLogger()->log('SETS: '.print_r($data['Sets'],true));
        foreach($data['Sets'] as &$s)
        {
            unset($s['id']);
            unset($s['program_id']);
            unset($s['Program']);
            unset($s['exercise_id']);

            $exercise = &$s['Exercise'];
            foreach($exercise['Images'] as &$img)
            {
                unset($img['id']);
                unset($img['exercise_id']);

                $n_file        = 'dup_'.$owner_id.'_'.preg_replace('/dup_\d+_/','',$img['filename']);
                $new_images[]  = $n_file;
                copy($path.$img['filename'],$path.$n_file);
                $img['filename'] = $n_file;

                foreach($img['Translation'] as $lang => &$img_t)
                    unset($img_t['id']);
            }

            foreach($exercise['Translation'] as $lang => &$exercise_t)
                unset($exercise_t['id']);

            unset($exercise['id']);
        }

        foreach($data['Translation'] as $lang => &$t)
            unset($t['id']);

        unset($data['id']);
        unset($data['created_at']);
        unset($data['updated_at']);

        $n_program = new Program();
        $n_program->fromArray($data,true);
        $n_program->owner_id     = $owner_id;
        $n_program->is_shareable = false;

        try
        {
            $n_program->save();
        }
        catch(Exception $e)
        {
            foreach($new_images as $n_file)
                unlink($path.$n_file);

            throw $e;
        }

        return $n_program;
    }
}