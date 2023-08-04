@extends('layouts.admin')
@section('content')
<div id="page-content-wrapper">
         <div class="container-fluid xyz">
            <div class="row justify-content-center">
               <div class="col-md-12">
                  <div  class="tab-category">
                        <ul>
                           <li><a href="index.html"><i class="fas fa-home"></i>Dashboard</a></li>
                           <li><i class="fas fa-dot-circle"></i>Subject</li>
                           <li><i class="fas fa-dot-circle"></i>List Result</li>
                        </ul>
                     </div>
                  <div class="datas-tables bg-light rounded my-2 pt-4 pb-5 px-5">
              <div class="d-flex justify-content-between">
                <h5 class=" text-dark">All Subjects result</h5>
                <input type="text" class="form-control w-25">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"> Add New </button>
               </div>

                     <hr style="margin-block: 20px;">
                     <table style="padding-top: 20px;padding-bottom: 20px;" class="table table-bordered table-striped table-hover">
                        <thead>
                           <tr>
                              <th>Category ID</th>
                              <th>Category Name</th>
                              <th>Publication Status</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>21</td>
                              <td>Kitchen & Dining</td>
                              <td>published</td>
                              <td>
                                 <a href="#" class="btn btn-success"><i class="fas fa-long-arrow-alt-down"></i></a>
                                 <a href="#" class="btn btn-info"><i style="color:#fff" class="far fa-edit"></i></a>
                                 <a href="#" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                              </td>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
        </div>

 @endsection
