class AuthorizationSessionController < ApplicationController
  def new  
    @authorization_session = AuthorizationSession.new  
  end  
  
  def create  
    @authorization_session = AuthorizationSession.new(params[:authorization_session])  
    if @authorization_session.save  
      flash[:notice] = "Login successful!"  
      redirect_back_or_default authorization_path  
    else  
      render :action => :new  
    end  
  end  
end
