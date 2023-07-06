<?php

namespace App\Controllers;

use App\Models\TweetModel;
use CodeIgniter\Files\File;
use CodeIgniter\HTTP\RedirectResponse;

class Tweet extends BaseController
{
    var $categories;
    var $sess;
    var $curUser;

    var $tweetMdl;
    var $profile;

    public function __construct()
    {
        $this->categories = (new \Config\AdtConfig())->getCategories();
        $this->sess = session();
        $this->curUser = $this->sess->get('currentuser');

        $this->tweetMdl = new TweetModel();
        $userMdl = new \App\Models\UserModel();
        $this->profile = $userMdl->find($this->curUser['userid']);
    }

    public function index()
    {
        $data['categories'] = $this->categories;
        $data['judul'] = 'Tweet Terbaru';

        $data['profile'] = $this->profile;
        $data['tweets'] = $this->tweetMdl->getLatest();

        return view('tweet_home', $data);
    }

    public function category($category)
    {
        $data['categories'] = $this->categories;
        $data['judul'] = 'Tweet Terbaru';

        $data['profile'] = $this->profile;
        $data['tweets'] = $this->tweetMdl->getByCategory($category);

        return view('tweet_home', $data);
    }

    public function addForm()
    {
        $data['categories'] = $this->categories;
        return view('tweet_add', $data);
    }

    public function editForm($tweet_id)
    {
        $tweet = $this->tweetMdl->find($tweet_id);
        if ($tweet->user_id != $this->sess->get('currentuser')['userid']) {
            $this->sess->set('edittweet', 'error');
            return redirect()->to('/');
        }

        $data['categories'] = $this->categories;
        $data['tweet'] = $tweet;
        return view('tweet_edit', $data);
    }

    public function addTweet()
    {
        $foto = $this->request->getFile('image');

        if ($this->validate($this->tweetMdl->rulesAdd)) {
            $data['content'] = $this->request->getPost('content');
            $data['category'] = $this->request->getPost('category');

            if ($foto->getError() == 4) {
                $image = null;
            } else {
                if ($foto->isValid() && !$foto->hasMoved()) {
                    $image = $foto->getRandomName();
                    $foto->move('images', $image);
                }
            }

            $data['image'] = $image;
            $this->tweetMdl->newTweet($this->sess->get('currentuser'), $data);
            $this->sess->setFlashdata('addtweet', 'Berhasil posting');
            return redirect()->to('/');
        } else {
            $data['Validation'] = $this->validator;
            $data['categories'] = $this->categories;
            return view('tweet_add', $data);
        }
    }

    public function delTweet($tweet_id)
    {
        $tweet = $this->tweetMdl->find($tweet_id);

        // Check if the user is authorized to delete the tweet
        if ($tweet->user_id != $this->sess->get('currentuser')['userid']) {
            $this->sess->setFlashdata('deltweet', 'error');
            return redirect()->to('/');
        }

        // Delete the image file if it exists
        $image = $tweet->image;
        if ($image && file_exists(ROOTPATH . 'public/uploads/' . $image)) {
            unlink(ROOTPATH . 'public/uploads/' . $image);

            $result = $this->tweetMdl->delTweet($this->sess->get('currentuser')['userid'], $tweet_id);
            if ($result) {
                $this->sess->setFlashdata('deltweet', 'success');
            } else {
                $this->sess->setFlashdata('deltweet', 'error');
            }
            return redirect()->to('/');
        }
    }

    public function editTweet()
    {
        $tweetData = $this->request->getPost();
        $tweet = $this->tweetMdl->find($tweetData['id']);

        // Check if the user is authorized to edit the tweet
        if ($tweet->user_id != $this->sess->get('currentuser')['userid']) {
            $this->sess->setFlashdata('edittweet', 'error');
            return redirect()->to('/');
        }

        // Handle image upload
        $image = $this->request->getFile('image');
        if ($image->isValid() && !$image->hasMoved()) {
            // Delete the old image file
            $oldImage = $tweet->image;
            if ($oldImage && file_exists(ROOTPATH . 'public/uploads/' . $oldImage)) {
                unlink(ROOTPATH . 'public/uploads/' . $oldImage);
            }

            $newName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads', $newName);
            $tweetData['image'] = $newName;
        }

        $result = $this->tweetMdl->editTweet($this->request->getPost());
        if ($result) {
            $this->sess->setFlashdata('edittweet', 'success');
        } else {
            $this->sess->setFlashdata('edittweet', 'error');
        }

        return redirect()->to('/');
    }
}
