<?php

class UserProfilesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /userprofiles
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /userprofiles/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /userprofiles
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /userprofiles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /userprofiles/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEditEdit()
	{
		return View::make('user_profiles.edit');
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /userprofiles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /userprofiles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}